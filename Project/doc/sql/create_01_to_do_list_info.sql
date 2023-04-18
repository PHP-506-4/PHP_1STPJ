CREATE DATABASE to_do_list;

USE to_do_list;

CREATE TABLE to_do_list_info(
	list_no INT PRIMARY KEY AUTO_INCREMENT NOT NULL
	,list_title VARCHAR(60) NOT NULL
	,list_memo VARCHAR(1000)
	,list_comp_flg CHAR(1) DEFAULT ('0') NOT NULL
	,list_start_time CHAR(2)
	,list_start_minute CHAR(2)
	,list_end_time CHAR(2)
	,list_end_minute CHAR(2)
	);

-- COMMIT;

-- INSERT INTO to_do_list_info(list_title)
-- VALUES ("테스트");
