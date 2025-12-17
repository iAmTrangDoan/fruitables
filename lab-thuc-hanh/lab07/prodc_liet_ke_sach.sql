DELIMITER $$

CREATE PROCEDURE `bookstore`.`liet_ke_sach_theo_loai` (
    -- Tham số đầu vào: Mã loại sách cần tìm
    IN p_maloai VARCHAR(5)
)
BEGIN
    -- Câu lệnh SELECT để truy vấn sách dựa trên mã loại (imaloai)
    SELECT
        s.imasach,
        s.itensach
    FROM
        `bookstore`.`sach` s
    WHERE
        s.imaloai = p_maloai;
END$$

DELIMITER ;