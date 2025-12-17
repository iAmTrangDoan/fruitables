<?php
class News extends Db
{
    // Trả về danh sách tin, có phân trang
    public function list($page = 1, $perPage = 10)
    {
        $page = max(1, (int)$page);
        $perPage = max(1, (int)$perPage);
        $offset = ($page - 1) * $perPage;

        // lấy tổng
        $c = $this->select("select count(*) as c from news");
        $total = isset($c[0]['c']) ? (int)$c[0]['c'] : 0;

        // LIMIT uses integer literals to avoid PDO quoting which can break syntax
        $list = $this->select("select * from news order by id desc limit " . (int)$offset . ", " . (int)$perPage);
        return array('total' => $total, 'data' => $list);
    }

    // Trả về chi tiết 1 tin theo id
    public function detail($id)
    {
        $r = $this->select("select * from news where id = :id", array(':id' => $id));
        return isset($r[0]) ? $r[0] : null;
    }
}
