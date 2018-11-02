

create table DevTCE (
  idCode int PRIMARY KEY not null,
  DésignationCode text not null,
  Localisation text,
  UN varchar(5) ,
  Quantite int,
  PU float not null,
  Prix_Total float

);