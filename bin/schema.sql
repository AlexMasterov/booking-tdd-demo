CREATE TABLE IF NOT EXISTS "reservations" (
  "id"       INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  "date"     TEXT NOT NULL,
  "name"     TEXT NOT NULL,
  "email"    TEXT NOT NULL,
  "quantity" INTEGER NOT NULL
);
