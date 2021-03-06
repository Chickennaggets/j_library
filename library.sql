DROP SCHEMA IF EXISTS library;
CREATE SCHEMA library;
USE library;

DROP TABLE IF EXISTS folder;
CREATE TABLE folder(
id_folder integer auto_increment primary key not null,
name_folder varchar(10) unique,
note varchar(70)
);

DROP TABLE IF EXISTS accounts;
CREATE TABLE accounts(
id_account integer auto_increment primary key not null,
login varchar(30) unique,
ac_password varchar(30),
activated boolean,
adminn boolean,
regist_date datetime DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS song;
CREATE TABLE song(
id_song INTEGER auto_increment primary key not null,
name_song varchar(100) not null,
count integer,
author varchar(70),
id_folder integer not null,
rok integer,
note varchar(100),
foreign key (id_folder) references folder(id_folder)
);


insert into folder(name_folder) values ('K4');
insert into folder(name_folder) values ('K5');
insert into folder(name_folder) values ('WP9');
insert into folder(name_folder) values ('K6');
insert into folder(name_folder) values ('WP8');
insert into folder(name_folder) values ('WP10');
insert into folder(id_folder, name_folder) values (7, 'Eu6');
insert into folder(id_folder, name_folder) values(8, 'bez nazwy');
insert into folder(name_folder) values ('Wi4');
insert into folder(name_folder) values ('K10');
insert into folder(name_folder) values ('O8');
insert into folder(name_folder) values ('Al3');
insert into folder(name_folder) values ('U3');
insert into folder(name_folder) values ('Wi7');
insert into folder(name_folder) values ('Al2');
insert into folder(name_folder) values ('M6');
insert into folder(name_folder) values ('O9');
insert into folder(name_folder) values('Ps1');
insert into folder(name_folder) values('Ps2');
insert into folder(name_folder) values('U1');
insert into folder(name_folder) values('U2');
insert into folder(name_folder) values('U4');
insert into folder(name_folder) values('U5');
insert into folder(name_folder) values('U6');
insert into folder(name_folder) values('Wi1');
insert into folder(name_folder) values('Wi2');
insert into folder(name_folder) values('Wi3');
insert into folder(name_folder) values('Wi5');
insert into folder(name_folder) values('Wi6');
insert into folder(name_folder) values('Wi8');
insert into folder(name_folder) values('Wi9');
insert into folder(name_folder) values('WP1');
insert into folder(name_folder) values('WP2');
insert into folder(name_folder) values('WP3');
insert into folder(name_folder) values('WP4');
insert into folder(name_folder) values('WP6');
insert into folder(name_folder) values('WP5');
insert into folder(name_folder) values('WP7');
insert into folder(name_folder) values('U7');
insert into folder(name_folder) values('U8');
insert into folder(name_folder) values('U9');
insert into folder(name_folder) values('U10');
insert into folder(name_folder) values('Al1');
insert into folder(name_folder) values('Ad1');
insert into folder(name_folder) values('Ch1');



/*
 O9 - ?? ???????????? ?????????? - ??????????????
 Ps1 - ?? ???????????? ?????????? - ??????????????
 Ps2 - ?? ???????????? ?????????? - sdelano
 U1 - first shkaf - sdelano
 U2 - first shkaf - sdelano
 U3 - first shkaf - sdelano
 U4 - OK
 U5 - Ok
 U6 - ok
 wi1 - ok
 wi2 - ok
 wi3 - ok
 wi4 - ok
 wi5 - ok
 
*/

insert into song(name_song, count, author, id_folder) values ('B??g si?? rodzi', 87, 'M. Szulik', 1);
insert into song(name_song, count, author, id_folder) values ('Jasna Panna', 98, 'J. Maklakiewicz', 1);
insert into song(name_song, count, author, id_folder) values ('Pan z nieba', 86, 'S. Stuligrosz', 2);
insert into song(name_song, count, author, id_folder) values ('Popule Meus', 48, 'L. Viktoria', 3);
insert into song(name_song, count, author, id_folder) values ('Adeste fideles', 44, 'D. Willcock', 4);
insert into song(name_song, count, author, id_folder) values ('Vexilla Regis', 57, 'A. Bruckner', 5);
insert into song(name_song, count, author, id_folder, rok) values ('Pasja wg ??w. Jana', 38, 'M. Szulik', 6, 2013);
insert into song(name_song, count, author, id_folder, rok) values ('Pasja wg ??w. Jana', 3, 'M. Szulik', 6, 2013);
insert into song(name_song, count, author, id_folder) values ('S??aw j??zyku Tajemnic??', 39, 'M. Szulik', 8); 
insert into song(name_song, count, author, id_folder, rok) values ('Hoc Corpus', 50, 'M. Szulik', 8, 2016);
insert into song(name_song, count, author, id_folder) values ('Anima Christi', 64, 'F. Frisina', 7);
insert into song(name_song, count, author, id_folder) values ('Anima Christi', 41, 'F. Frisina', 7);
insert into song(name_song, count, author, id_folder, rok) values ('Gdy Pan wsta?? od wieczerzy', 58, 'M. Szulik', 8, 2014);
insert into song(name_song, count, author, id_folder, rok) values ('Regina coeli', 75, 'M. Szulik', 9, 2014);
insert into song(name_song, count, author, id_folder, rok) values ('Hosanna Filio David', 70, 'M. Szulik', 8, 2014);
insert into song(name_song, count, author, id_folder) values ('Chrystus Pan zmartwychsta??', 52, 'A. Nikodemowicz', 8);
insert into song(name_song, count, author, id_folder) values ('Alleluia, o filii et filie', 50, 'M. Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('Alleluia z oratorium Mesjasz', 34, 'G.F. Haendel', 8);
insert into song(name_song, count, author, id_folder) values ('Alleluia z oratorium Mesjasz', 33, 'G.F. Haendel', 8);
insert into song(name_song, count, author, id_folder, rok) values ('Pasja wg ??w. ??ukasza', 25, 'M. Szulik', 8, 2010);
insert into song(name_song, count, author, id_folder, rok) values ('Pasja wg ??w. ??ukasza', 23, 'M. Szulik', 8, 2010);
insert into song(name_song, count, author, id_folder) values ('Pozw??l mi Twe m??ki ??piewa??', 67, 'A. Nikodemowicz', 8);
insert into song(name_song, count, author, id_folder, rok) values ('Bo??e w dobroci', 30, 'M. Szulik', 8, 2020);
insert into song(name_song, count, author, id_folder, rok) values ('Bo??e w dobroci', 23, 'M. Szulik', 8, 2020);
insert into song(name_song, count, author, id_folder) values ('Tryumfy Kr??la Niebieskiego', 77, 'S. Stuligrosz', 10);
insert into song(name_song, count, author, id_folder, rok) values ('Chwa???? nasz?? jest Krzy??', 48, 'M. Szulik', 3, 2010);
insert into song(name_song, count, author, id_folder) values ('Chrisus factus est', 52, 'F. Anerio', 6);
insert into song(name_song, count, author, id_folder) values ('Przyjmij, o Naj??wi??tsy Panie', 32, 'M. Szulik', 8);
insert into song(name_song, count, author, id_folder, rok) values ('Jesu mi??o??ci Twej', 36, 'M. Szulik', 8, 2020);
insert into song(name_song, count, author, id_folder, rok) values ('Bogu z Jego dar??w', 26, 'M. Szulik', 8, 2020);
insert into song(name_song, count, author, id_folder, rok) values ('By?? bli??ej Ciebie chc??', 32, 'M. Szulik', 8, 2020);
insert into song(name_song, count, author, id_folder, rok) values ('Now?? pie???? za??piewajcie', 59, 'M. Szulik', 8, 2020);
insert into song(name_song, count, author, id_folder) values ('Ciebie na wieki', 40, 'H.M. G??recki', 8);
insert into song(name_song, count, author, id_folder) values ('Zawitaj Ukrzy??owany', 37, 'A. Nikodemowicz', 8);
insert into song(name_song, count, author, id_folder) values ('Chwa??a Tobie (Daj?? wam..)', 44, 'M. Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('Chwa??a Tobie (Dla nas..)', 42, 'M. Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('Chrysus, Chrystus to nadzieja', 43, 'M. Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('Jezu dulcis memoria', 52, 'L. Bardos', 11);
insert into song(name_song, count, author, id_folder) values ('Alleluja', 59, 'Kanon in G', 12);
insert into song(name_song, count, author, id_folder) values ('??piewaj, ??piewaj sercem ca??ym', 78, 'M. Stecka', 13);
insert into song(name_song, count, author, id_folder) values ('Dobranoc G??owo ??wi??ta', 45, 'A. Nikodemowicz', 8);
insert into song(name_song, count, author, id_folder) values ('Kto jest s??ug?? Matki ??wi??tej', 50, 'St. Wiechowicz', 8);
insert into song(name_song, count, author, id_folder) values ('P??aczcie anieli', 48, 'A. Nikodemowicz', 8);
insert into song(name_song, count, author, id_folder) values ('Odszed?? Pasterz od nas', 81, 'A. Zola', 8);
insert into song(name_song, count, author, id_folder) values ('Ty, kt??ry?? gorzko na krzy??u umiera??', 65, 'St. Wiechowicz', 8);
insert into song(name_song, count, author, id_folder) values ('Surrexit a mortuis', 64, 'Ch. Widor', 14);
insert into song(name_song, count, author, id_folder, rok) values ('Tobie cze????, Tobie chwa??a', 45, 'M. Szulik', 6, 2010);
insert into song(name_song, count, author, id_folder) values ('Jesu bleibet meine Freude', 47, 'J.S. Bach', 8);
insert into song(name_song, count, author, id_folder) values ('Chrystus wodzem', 79, 'M. Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('Canticorum iubilo', 37, 'G.F. Haendel', 8);
insert into song(name_song, count, author, id_folder) values ('Alleluja (Nie wy??cie..)', 30, 'C. Mawby', 8);
insert into song(name_song, count, author, id_folder) values ('Misericordias domini', 70, 'J. Botor', 8);
insert into song(name_song, count, author, id_folder) values ('O przyjdzcie, rado??nie ??piewamy', 37, 'C. Mawby', 8);
insert into song(name_song, count, author, id_folder) values ('Teraz uwalniasz', 39, 'Ch. V. Stanford', 8);
insert into song(name_song, count, author, id_folder) values ('Tak B??g umi??owa?? ??wiat', 41, 'J. Stainer', 8);
insert into song(name_song, count, author, id_folder) values ('Psalm 84', 20, 'M. Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('Psalm 84', 16, 'M. Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('Ave Maria II', 36, 'F. Liszt', 8);
insert into song(name_song, count, author, id_folder) values ('O sacrum convivium', 55, 'L. Perosi', 8);
insert into song(name_song, count, author, id_folder) values ('Ku Tobie Panie wznosim ??piew', 23, 'Ch. Wood', 8);
insert into song(name_song, count, author, id_folder) values ('Z g????boko??ci grzech??w moich', 37, 'C. Bazylik', 8);
insert into song(name_song, count, author, id_folder) values ('Niech Ci?? Pan b??ogos??awi i strze??e', 23, 'J. Rutter', 8);
insert into song(name_song, count, author, id_folder) values ('K??aniam si?? Tobie', 61, 'M. Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('Alleluja', 57, 'z bazyliki ??w. Piotra w Rzymie', 8);
insert into song(name_song, count, author, id_folder) values ('Alleluja', 65, 'S. Kwiatkowski', 15);
insert into song(name_song, count, author, id_folder) values ('Chrysus, Chrystus to nadzieja', 34, 'M. Szulik', 8);
insert into song(name_song, count, author, id_folder, rok) values ('Ave verum corpus', 29, 'M. Szulik', 8, 2016);
insert into song(name_song, count, author, id_folder) values ('Veni Sancte Spiritus', 40, 'J. Revert', 8);
insert into song(name_song, count, author, id_folder) values ('Veni Sancte Spiritus', 30, 'M. Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('Exsultate Justi', 34, 'Viadana', 8);
insert into song(name_song, count, author, id_folder) values ('Ave Maria', 27, 'ks. Alfred Hoffman (1923-1994)', 8);
insert into song(name_song, count, author, id_folder) values ('O Chryste', 33, 'Colin Mawby, t??. ks. Micha??R. Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('Adoracja krzy??a, bloki (2014)', 61, ' - ', 3);
insert into song(name_song, count, author, id_folder) values ('Quae est ista', 12, 'Cesar Franck (1822-1890)', 8);
insert into song(name_song, count, author, id_folder) values ('Quae est ista', 16, 'Cesar Franck (1822-1890)', 8);
insert into song(name_song, count, author, id_folder) values ('Quae est ista', 11, 'Cesar Franck (1822-1890)', 8);
insert into song(name_song, count, author, id_folder) values ('Victime Paschali laudes', 95, 'opr. J.Revert', 8);
insert into song(name_song, count, author, id_folder) values ('Dextera Domini', 19, 'Cesar Franck', 8);
insert into song(name_song, count, author, id_folder) values ('Haec dies', 45, 'M. Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('Dextera Domini', 20, 'Cesar Franck', 8);
insert into song(name_song, count, author, id_folder) values ('Jubilate Deo', 43, 'Colin Mawby', 8);
insert into song(name_song, count, author, id_folder) values ('Iesum Christum praedicare', 7, 'ks. Micha?? R.Szulik (kwiecie?? 2020)', 8);
insert into song(name_song, count, author, id_folder) values ('O sacrum convivium', 26, 'Colin Mawby', 8);
insert into song(name_song, count, author, id_folder) values ('Laudate Dominum', 44, 'Giuseppe Zelioli', 8);
insert into song(name_song, count, author, id_folder) values ('Ubi caritas', 27, 'Nicolas Palmer', 8);
insert into song(name_song, count, author, id_folder) values ('Pater meus', 31, 'A. Tucapsky', 8);
insert into song(name_song, count, author, id_folder) values ('In monte oliveti', 16, 'Giovanni Battista Martini - ofm (1706-1784)', 8);
insert into song(name_song, count, author, id_folder) values ('Com przyrzek?? Bogu', 53, 'opr. M. Pearson/ ks. M.R. Szulik (2017)', 8);
insert into song(name_song, count, author, id_folder) values ('Wierz?? w jednego Boga', 48, 'Ks. W. Lewkowicz', 8);
insert into song(name_song, count, author, id_folder) values ('Pami??tk?? dnia ??wi??tecznego', 39, 'harm. A. Chlondowski opr. ks. M.R. Szulik (2019)', 8);
insert into song(name_song, count, author, id_folder) values ('Najdro??szy Jesu', 24, 'J. Heermann, J. Cruger', 8);
insert into song(name_song, count, author, id_folder) values ('Ave maris stella', 31, 'ks. M.R.Szulik', 16);
insert into song(name_song, count, author, id_folder) values ('Niech w ??wi??to radosne', 2, 'ks. I. Pawlak', 8);
insert into song(name_song, count, author, id_folder) values ('Jezu, zmi??uj si??', 33, 'ks. J??zef Surzy??ski (1851-1919)', 8);
insert into song(name_song, count, author, id_folder) values ('Ach, m??j niebieski Panie', 25, 'Wac??aw z Szmotu?? (1526-1560)', 8);
insert into song(name_song, count, author, id_folder) values ('Kto si?? w opiek??', 19, 'opr. ks. M.R. Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('C???? Ci Jezu damy', 46, 'opr. ks. A. Hoffman', 8);
insert into song(name_song, count, author, id_folder) values ('B??g nad swym ludem', 44, 'opr. ks. M.R. Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('Ciebie Bo??e chwalimy', 25, 'C.N. Schmid', 8);
insert into song(name_song, count, author, id_folder) values ('Messe Basse I.Kyrie eleison', 28, 'Gabriel Faure (1845-1924)', 8);
insert into song(name_song, count, author, id_folder) values ('Messe Basse II.Sanctus', 22, 'Gabriel Faure (1845-1924)', 8);
insert into song(name_song, count, author, id_folder) values ('Messe Basse III.Benedictus', 21, 'Gabriel Faure (1845-1924)', 8);
insert into song(name_song, count, author, id_folder) values ('Messe Basse IV.Agnus Dei', 22, 'Gabriel Faure (1845-1924)', 8);
insert into song(name_song, count, author, id_folder) values ('Psalm 150', 19, 'Cesar Franck (1822-1890)', 8);
insert into song(name_song, count, author, id_folder) values ('Psalm 150', 15, 'Cesar Franck (1822-1890)', 8);
insert into song(name_song, count, author, id_folder) values ('Wska?? mi Panie', 41, 'Ch. Wood opr. xMRS', 17);
insert into song(name_song, count, author, id_folder) values ('Abide with me', 59, 'M. Archer opr. i t??. ks. M.R. Szulik', 17);
insert into song(name_song, count, author, id_folder) values ('Tu es Petrus', 50, 'ks. M.R. Szulik (2014)', 17);
insert into song(name_song, count, author, id_folder) values ('Abide with me', 49, 'M. Archer opr. i t??. ks. M.R. Szulik', 17);
insert into song(name_song, count, author, id_folder) values ('Iesu, in Te confido', 50, 'ks. M.R. Szulik (2014)', 17);
insert into song(name_song, count, author, id_folder) values ('Kryste, dniu naszej ??wiat??o??ci', 65, 'Wac??aw z Szamotu?? (XVI w.)', 18);
insert into song(name_song, count, author, id_folder) values ('Modlitwa, gdy dziatki spa?? id??', 34, 'W. Szamotulczyk', 18);
insert into song(name_song, count, author, id_folder) values ('B??agos??awiony cz??owiek', 47, 'Wac??aw z Szamotu?? (XVI w.)', 18);
insert into song(name_song, count, author, id_folder) values ('Alleluja. Chwalcie Pana', 68, 'M. Gom????ka', 18);
insert into song(name_song, count, author, id_folder) values ('Ach, m??j Niebieski Panie', 55, 'Wac??aw z Szamotu?? (XVI w.)', 18);
insert into song(name_song, count, author, id_folder) values ('Kleszczmy r??koma wszyscy zgodliwie (Psalm XLVII)', 38, 'M. Gom????ka, J. Kochanowski', 19);
insert into song(name_song, count, author, id_folder) values ('Kr??lowie s??dz?? poddane', 58, 'M. Gom????ka', 19);
insert into song(name_song, count, author, id_folder) values ('M??j wiekuisty pasterz mi?? pasie (Psalm 23)', 44, 'J. Kochanowski', 19);
insert into song(name_song, count, author, id_folder) values ('Jako rzesc pi??kna, jako rzecz przyjemna', 32, 'M. Gom????ka', 19);
insert into song(name_song, count, author, id_folder) values ('Nie??cie chwa???? mocarze', 37, 'J. Kochanowski', 19);
insert into song(name_song, count, author, id_folder) values ('Chwalcie Pana', 53, 'J. Clarke (1670-1707)', 20);
insert into song(name_song, count, author, id_folder) values ('Chora?? z1 147 kantaty', 85, 'J. S. Bach', 20);
insert into song(name_song, count, author, id_folder) values ('Jubilate Deo universa terra', 32, 'Lazlo Halmos', 20);
insert into song(name_song, count, author, id_folder) values ('G??o?? Imi?? Pana', 54, 'R.A.Hobby, M.Szulik', 20);
insert into song(name_song, count, author, id_folder) values ('Zwyci??zca ??mierci', 54, 'R.A.Hobby, M.Szulik', 20);
insert into song(name_song, count, author, id_folder) values ('Laudate nomen Domini', 55, 'Chrystopher Tye', 21);
insert into song(name_song, count, author, id_folder) values ('Benedictus', 64, 'J. Maklakiewicz', 21);
insert into song(name_song, count, author, id_folder) values ('Laudate Dominum', 45, 'Ch. Gounod', 21);
insert into song(name_song, count, author, id_folder) values ('Cantate Domino', 47, 'G.O. Pitoni', 21);
insert into song(name_song, count, author, id_folder) values ('Cantate Domino', 43, 'C.A. Gounod', 21);
insert into song(name_song, count, author, id_folder) values ('Exultate Deo', 59, 'Alessandro Scarlatti', 13);
insert into song(name_song, count, author, id_folder) values ('Chwalcie Pana', 60, 'ks. J.Orszulik, akomp. ks. M.Szulik', 13);
insert into song(name_song, count, author, id_folder) values ('??wiety, ??wi??ty, ??wi??ty', 36, 'H.M. G??recki', 13);
insert into song(name_song, count, author, id_folder) values ('Laudate Dominum', 43, 'W.A.Mozart (1756-1791)', 22);
insert into song(name_song, count, author, id_folder) values ('C??rko Syjo??ska (I cz.)', 93, 'G.F. Haendel (1685-1759)', 22);
insert into song(name_song, count, author, id_folder) values ('C??rko Syjo??ska (II cz.)', 91, 'G.F. Haendel (1685-1759)', 22);
insert into song(name_song, count, author, id_folder) values ('Te, Deum, laudamus', 110, 'ks. KaryCowski - M.Ks.A.Clondowski', 23);
insert into song(name_song, count, author, id_folder) values ('Jubilate Deo', 35, 'Franz XaverWitt *1834-1888)', 23);
insert into song(name_song, count, author, id_folder) values ('Omnis terra Deo jubilate', 45, 'L. Halmos (1907-1997)', 23);
insert into song(name_song, count, author, id_folder) values ('Ciebie Boga wys??awiamy', 82, 'ks. M.R.Szulik', 23);
insert into song(name_song, count, author, id_folder) values ('Laudate Dominum', 83, 'ks. M.R.Szulik', 23);
insert into song(name_song, count, author, id_folder) values ('Ciebie Boga wys??awiamy', 41, 'ks. M.R.Szulik', 23);
insert into song(name_song, count, author, id_folder) values ('Adorate Deum', 43, 'ks. M.R.Szulik', 23);
insert into song(name_song, count, author, id_folder) values ('Psalm 150, Chwalcie Boga w jego ??wi??tyni', 27, 'ks. M.R.Szulik', 24);
insert into song(name_song, count, author, id_folder) values ('Alleluja', 22, 'opr. A. Ch??ondowski', 25);
insert into song(name_song, count, author, id_folder) values ('Alleluja', 89, 'opr. A. Ch??ondowski', 25);
insert into song(name_song, count, author, id_folder) values ('Kr??lowo nieba', 44, 'G. Aichinger', 26);
insert into song(name_song, count, author, id_folder) values ('Regina coeli', 105, 'G. Aichinger', 26);
insert into song(name_song, count, author, id_folder) values ('Zwyci??zca ??mierci', 66, 'ks. A.Ch??ondowski', 27);
insert into song(name_song, count, author, id_folder) values ('Oto s?? baranki m??ode', 58, 'J. Galuszka', 27);
insert into song(name_song, count, author, id_folder) values ('Haec dies', 35, 'M. Ziele??ski', 27);
insert into song(name_song, count, author, id_folder) values ('Regnavit Dominus', 66, 'J. Galuszka', 27);
insert into song(name_song, count, author, id_folder) values ('Zwyci??zca ??mierci', 49, 'ks. A.Ch??ondowski', 27);
insert into song(name_song, count, author, id_folder) values ('Oto s?? baranki m??ode', 41, 'ks. A.S.', 9);
insert into song(name_song, count, author, id_folder) values ('Uczcijmy Zmartwychwsta??ego', 49, 'ks. M.R.Szulik', 9);
insert into song(name_song, count, author, id_folder) values ('Oto s?? Baranki', 62, 'ks. M.R.Szulik (16.01.2013)', 9);
insert into song(name_song, count, author, id_folder) values ('Regina coeli laetare', 52, 'A. Lotti', 9);
insert into song(name_song, count, author, id_folder) values ('Alleluja z oratorium Mesjasz', 39, 'G.F. Handel', 28);
insert into song(name_song, count, author, id_folder) values ('Hallelujah (cz. 44)', 21, 'G.F. Handel', 29);
insert into song(name_song, count, author, id_folder) values ('Hallelujah (cz. 44)', 13, 'G.F. Handel', 29);
insert into song(name_song, count, author, id_folder) values ('Surrexit a mortius', 59, 'C.M. Widor', 14);
insert into song(name_song, count, author, id_folder) values ('Zeszyty Wielkanoc', 43, ' - ', 30);
insert into song(name_song, count, author, id_folder) values ('Zeszyty Wielkanoc', 31, ' - ', 31);
insert into song(name_song, count, author, id_folder) values ('Pie??ni wielkopostne', 2, ' - ', 32);
insert into song(name_song, count, author, id_folder) values ('Pie??ni wielkopostne', 1, ' - ', 33);
insert into song(name_song, count, author, id_folder) values ('Improperia', 22, 'ks. M.R.Szulik (2005-2006)', 34);
insert into song(name_song, count, author, id_folder) values ('Improperia', 30, 'ks. M.R.Szulik (2005-2006)', 34);
insert into song(name_song, count, author, id_folder) values ('Pasja wg ??w. Mateusza', 36, 'Ks. A.Hoffman (1923-1994)', 35);
insert into song(name_song, count, author, id_folder) values ('Lament Matki Boskiej', 67, 'Ks. A.Hoffman (1923-1994)', 36);
insert into song(name_song, count, author, id_folder) values ('Krzy??u ??wi??ty', 18, 'Ks. A.Hoffman (1923-1994)', 36);
insert into song(name_song, count, author, id_folder) values ('Dzieci Hebrajskie', 55, 'Ks. A.Hoffman (1923-1994)', 36);
insert into song(name_song, count, author, id_folder) values ('Ho??d Tobie', 50, 'Ks. A.Hoffman (1923-1994)', 36);
insert into song(name_song, count, author, id_folder) values ('Chwa??a Tobie Kr??lu wiek??w', 94, 'Ks. A.Hoffman (1923-1994)', 36);
insert into song(name_song, count, author, id_folder) values ('Na skrzy??owaniu ??wiata dr??g', 65, 'Ks. A.Hoffman (1923-1994)', 36);
insert into song(name_song, count, author, id_folder) values ('Antyfona na ??rod?? popielcow??', 51, 'ks. M.R.Szulik', 36);
insert into song(name_song, count, author, id_folder) values ('Werset na Niedziel?? Palmow?? & Wielki Czwartek', 24, ' - ', 36);
insert into song(name_song, count, author, id_folder) values ('Mi??o???? czy??cie i pokut??', 24, 'ks. M.R.Szulik', 36);
insert into song(name_song, count, author, id_folder) values ('Pasja wg ??w. Mateusza', 31, 'Ks. A.Hoffman (1923-1994)', 37);
insert into song(name_song, count, author, id_folder) values ('Stabat Mater', 59, 'Z.Kodaly', 38);
insert into song(name_song, count, author, id_folder) values ('Parce domine', 43, 'Feliks Nowowiejski', 38);
insert into song(name_song, count, author, id_folder) values ('O wy wszyscy', 63, 'G. Croce', 38);
insert into song(name_song, count, author, id_folder) values ('O vos omnes', 66, 'G. Croce', 38);
insert into song(name_song, count, author, id_folder) values ('O G??owo uwie??czona', 73, 'J.S. Bach', 38);
insert into song(name_song, count, author, id_folder) values ('Miserere', 45, 'Antonio Lotti (1667-1740)', 38);
insert into song(name_song, count, author, id_folder) values ('Locus iste', 41, 'A. Bruckner (1824-1896)', 5);
insert into song(name_song, count, author, id_folder) values ('P??aczcie anieli', 30, 'Ks. A.Hoffman (1923-1994)', 5);
insert into song(name_song, count, author, id_folder) values ('In monte Oliveti', 67, 'A. Bruckner (1824-1896)', 5);
insert into song(name_song, count, author, id_folder) values ('Ubi caritas - wersety', 55, 'ks. M.R.Szulik', 5);
insert into song(name_song, count, author, id_folder) values ('Crucem Tuam', 59, 'ks. M.R.Szulik (2010)', 3);
insert into song(name_song, count, author, id_folder) values ('Stabat Mater', 13, ' - ', 3);
insert into song(name_song, count, author, id_folder) values ('De actione liturgica postmeridiana', 16, ' - ', 3);
insert into song(name_song, count, author, id_folder) values ('Adoracja krzy??a, bloki (2014)', 94, ' - ', 3);
insert into song(name_song, count, author, id_folder) values ('Immutemur Habitu', 44, 'J. Garcia', 6);
insert into song(name_song, count, author, id_folder) values ('Domine, tu mihi', 24, 'ks. M.R.Szulik', 6);
insert into song(name_song, count, author, id_folder) values ('Ecce quomodo moritur', 57, 'T. Victoria', 6);
insert into song(name_song, count, author, id_folder) values ('??piewy wielkiego tygodnia', 38, ' - ', 6);
insert into song(name_song, count, author, id_folder) values ('Charles Gounod Te Deum', 17, ' - ', 23);
insert into song(name_song, count, author, id_folder) values ('Charles Gounod Te Deum', 19, ' - ', 24);
insert into song(name_song, count, author, id_folder) values ('Charles Gounod Te Deum', 18, ' - ', 39);
insert into song(name_song, count, author, id_folder) values ('Charles Gounod Te Deum', 11, ' - ', 40);
insert into song(name_song, count, author, id_folder) values ('Te Deum Laudamus', 20, 'ks. M.R.Szulik', 41);
insert into song(name_song, count, author, id_folder) values ('Te Deum Laudamus', 29, 'ks. M.R.Szulik', 42);
insert into song(name_song, count, author, id_folder) values ('Dextera Domini', 32, 'C. Franck (1822-1890)', 8);
insert into song(name_song, count, author, id_folder) values ('Cicha noc', 25, 'H.Hopson opr. x. M.R.Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('B??ogos??awieni mi??osierni', 67, 'ks. M.R.Szulik', 8);
insert into song(name_song, count, author, id_folder) values ('Pie??ni wielkopostne na ch??r mieszany a capella', 27, ' - ', 8);
insert into song(name_song, count, author, id_folder) values ('Alleluja', 39, 'Z. Nowacki', 43);
insert into song(name_song, count, author, id_folder) values ('Alleluja Wielkanocne', 58, ' - ', 43);
insert into song(name_song, count, author, id_folder) values ('??piew przed Ewangeli?? (3 maja)', 49, ' - ', 43);
insert into song(name_song, count, author, id_folder) values ('??piew przed Ewangeli?? (Wspomnienie Sw. Wiktorii)', 50, ' - ', 43);
insert into song(name_song, count, author, id_folder) values ('??piew przed Ewangeli?? (IV Niedziela Wielkanocna)', 56, ' - ', 43);
insert into song(name_song, count, author, id_folder) values ('Alleluja', 35, 'ks. A. Hoffman', 15);
insert into song(name_song, count, author, id_folder) values ('Alleluja', 45, ' - ', 15);
insert into song(name_song, count, author, id_folder) values ('Alleluja', 71, 'W. Boyce (1700)', 15);
insert into song(name_song, count, author, id_folder) values ('Alleluja in Des & in Es', 47, ' - ', 15);
insert into song(name_song, count, author, id_folder) values ('Alleluja. Dic nobis', 139, 'ks. M.R.Szulik', 12);
insert into song(name_song, count, author, id_folder) values ('Alleluja', 43, 'ks. M.R.Szulik', 12);
insert into song(name_song, count, author, id_folder) values ('Ad te levavi', 41, 'F.X.Witt', 44);
insert into song(name_song, count, author, id_folder) values ('Radujcie si??, bo Pan przybywa', 16, 'ks. M.R.Szulik', 44);
insert into song(name_song, count, author, id_folder) values ('Przygotujcie drogi dla Pana', 38, ' - ', 44);
insert into song(name_song, count, author, id_folder) values ('Radujcie si??, bo Pan przybywa', 26, 'ks. M.R.Szulik', 44);
insert into song(name_song, count, author, id_folder) values ('Veni, veni Emmanuel', 41, 'Z. Koda??y', 44);
insert into song(name_song, count, author, id_folder) values ('Veni, veni Emmanuel', 41, 'D. Willcocks (*1919)', 44);
insert into song(name_song, count, author, id_folder) values ('Chrystus Wodzem', 53, 'N.N.', 45);
insert into song(name_song, count, author, id_folder) values ('Christus vincit', 10, 'N.N.', 45);
insert into song(name_song, count, author, id_folder) values ('Chrystus Wodzem', 31, 'N.N.', 45);
insert into song(name_song, count, author, id_folder) values ('Ciebie Chryste wyznajemy', 43, 'ks. M.R.Szulik (2010)', 45);
insert into song(name_song, count, author, id_folder) values ('B??g nad swym ludem', 50, 'ks. W.K??dziela, harm. x MRS', 45);
insert into song(name_song, count, author, id_folder) values ('Christus Rex', 185, 'Nowowiejski', 45);




select * from folder order by name_folder;
select id_song as Numer, name_song as Nazwa_utworu, count as Ilosc, author as Autor, folder.name_folder as Teczka from song left join folder on song.id_folder = folder.id_folder order by name_song; 

insert into accounts(login, ac_password, activated, adminn) values('Phryme', 'Jason2907', true, true);
insert into accounts(login, ac_password, activated, adminn) values('Angel', '1234', false, false);
insert into accounts(login, ac_password, activated, adminn) values('Johnny', '1234', false, false);
insert into accounts(login, ac_password, activated, adminn) values('Eva', '1234', true, false);

select * from accounts;

