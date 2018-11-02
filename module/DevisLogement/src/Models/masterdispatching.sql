


create table masterdispatching (
  nomlot varchar(35) ,
  initiallot varchar(25),
  codemetc INT8,
  numordre varchar(25),
  numerodossier varchar(4),
  numeroprojet varchar(4),
  annee varchar(4),
  designation text,
  emplacement text,
  quantite float ,
  un varchar(5),
  puht float,
  totalht float

);


create table PAFI (

idpafi serial not null,
idlogementconcerne int not null,
etatenvoiepafi text,
dateenvoiepafi date,
dateprevisionnelleretourpafi date,
retourpafi text,
datereelretourpafi date
);


create table chargeop (
idchargeop serial not null,
nomchargeop varchar(30),
prenomchargeop varchar(30),
abrevationchargeop varchar(10)

);

create table maitriseoeuvre (
idmaitriseoeuvre serial not null,
nombureaucode varchar(45),
idpersonneconcerne int


);




create table DataMaisonetCites (

numeroarticle varchar(15),
libelleArticle text,
UN varchar(10),
puht float
);