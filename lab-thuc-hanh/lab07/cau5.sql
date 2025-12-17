cau 5.1
SELECT
    s.imasach,
    s.itensach,
    l.imaloai AS maloai,  
    l.itenloai AS tenloai 
FROM
    `sach` s
INNER JOIN
    `loai` l ON s.imaloai = l.imaloai
ORDER BY
    l.imaloai, s.itensach;

cau 5.2
DELIMITER $$

CREATE PROCEDURE `cap_nhat_gia_sach` (
    -- Tham số đầu vào 1: Mã sách cần cập nhật
    IN p_imasach VARCHAR(15),
    -- Tham số đầu vào 2: Giá mới cho sách
    IN p_gia_moi FLOAT
)
BEGIN
    -- Câu lệnh UPDATE để thay đổi giá trong bảng 'sach'
    UPDATE
	`sach`
    SET
        gia = p_gia_moi
    WHERE
        imasach = p_imasach;
END$$

DELIMITER ;

cau5.3
SELECT
    s.imasach,
    s.itensach,
    SUM(c.soluong) AS tong_so_luong_ban
FROM
    `chitiethd` c
INNER JOIN
    `sach` s ON c.imasach = s.imasach
GROUP BY
    s.imasach, s.itensach
ORDER BY
    tong_so_luong_ban DESC
LIMIT 1;

cau5.4
CREATE VIEW `view_top_10_sach_ban_chay` AS
SELECT
    s.imasach,
    s.itensach,
    SUM(c.soluong) AS tong_so_luong_ban
FROM
    `chitiethd` c
INNER JOIN
    `sach` s ON c.imasach = s.imasach
GROUP BY
    s.imasach, s.itensach
ORDER BY
    tong_so_luong_ban DESC
LIMIT 10;