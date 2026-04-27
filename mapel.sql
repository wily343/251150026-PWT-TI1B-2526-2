-- Tabel untuk mapel
CREATE TABLE `mapel` (
  `Kd_mapel` varchar(10) NOT NULL,
  `Nm_mapel` varchar(100) DEFAULT NULL,
  `Kkm` int DEFAULT NULL,
  PRIMARY KEY (`Kd_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Contoh data
INSERT INTO `mapel` (`Kd_mapel`, `Nm_mapel`, `Kkm`) VALUES
('M001', 'Matematika', 75),
('M002', 'Bahasa Indonesia', 70);