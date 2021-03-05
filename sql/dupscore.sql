CREATE TEMPORARY TABLE mytmp AS 
SELECT p1.pid, MAX(
  (TRIM(p1.fname) = TRIM(p2.fname)) * 5 +
  (TRIM(p1.lname) = TRIM(p2.lname)) * 3 +
  ( (TRIM(p1.phone_home) != '' AND (
      REPLACE(REPLACE(p1.phone_home, '-', ''), ' ', '') = REPLACE(REPLACE(p2.phone_home, '-', ''), ' ', '') OR
      REPLACE(REPLACE(p1.phone_home, '-', ''), ' ', '') = REPLACE(REPLACE(p2.phone_biz , '-', ''), ' ', '') OR
      REPLACE(REPLACE(p1.phone_home, '-', ''), ' ', '') = REPLACE(REPLACE(p2.phone_cell, '-', ''), ' ', '')))
    OR (TRIM(p1.phone_biz) != '' AND (
      REPLACE(REPLACE(p1.phone_biz , '-', ''), ' ', '') = REPLACE(REPLACE(p2.phone_biz , '-', ''), ' ', '') OR
      REPLACE(REPLACE(p1.phone_biz , '-', ''), ' ', '') = REPLACE(REPLACE(p2.phone_cell, '-', ''), ' ', '')))
    OR (TRIM(p1.phone_cell) != '' AND (
      REPLACE(REPLACE(p1.phone_cell, '-', ''), ' ', '') = REPLACE(REPLACE(p2.phone_cell, '-', ''), ' ', '')))
  ) * 4 +
  (p1.DOB IS NOT NULL AND p2.DOB IS NOT NULL AND p1.DOB = p2.DOB) * 6 +
  (TRIM(p1.email) != '' AND TRIM(p2.email) != '' AND TRIM(p1.email) = TRIM(p2.email)) * 7 +
  (TRIM(p1.ss) != '' AND TRIM(p2.ss) != '' AND TRIM(p1.ss) = TRIM(p2.ss)) * 15
) AS dupscore
FROM patient_data AS p1, patient_data AS p2
WHERE p1.dupscore = -9 AND p2.pid < p1.pid
GROUP BY p1.pid ORDER BY p1.pid;
UPDATE patient_data AS p1, mytmp SET p1.dupscore = mytmp.dupscore
WHERE p1.pid = mytmp.pid;
