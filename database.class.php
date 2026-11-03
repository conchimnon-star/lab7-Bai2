<?php

class Dao
{
    private $con;

    public function __construct($user, $pass, $db)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $this->con = mysqli_connect('localhost', $user, $pass, $db);
            mysqli_set_charset($this->con, 'utf8mb4');
        } catch (mysqli_sql_exception $e) {
            error_log('Database connection error: ' . $e->getMessage());
            throw new RuntimeException('Không thể kết nối tới database udn.', 0, $e);
        }
    }

    public function query($sql)
    {
        try {
            return mysqli_query($this->con, $sql);
        } catch (mysqli_sql_exception $e) {
            error_log('Database query error: ' . $e->getMessage());
            throw new RuntimeException('Không thể truy vấn dữ liệu.', 0, $e);
        }
    }

    public function table($sql, $header)
    {
        $result = $this->query($sql);
        $fields = mysqli_fetch_fields($result);

        echo '<h2>' . self::escapeHtml($header) . '</h2>';

        if ($fields === array()) {
            echo '<p class="message">Truy vấn không trả về thông tin cột.</p>';
            mysqli_free_result($result);
            return;
        }

        echo '<div class="table-wrap"><table class="data-table"><thead><tr>';
        foreach ($fields as $field) {
            echo '<th scope="col">' . self::escapeHtml($field->name) . '</th>';
        }
        echo '</tr></thead><tbody>';

        $hasRows = false;
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            $hasRows = true;
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . self::escapeHtml($value) . '</td>';
            }
            echo '</tr>';
        }

        echo '</tbody></table></div>';
        if (!$hasRows) {
            echo '<p class="message">Bảng này hiện chưa có dữ liệu.</p>';
        }

        mysqli_free_result($result);
    }

    private static function escapeHtml($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
