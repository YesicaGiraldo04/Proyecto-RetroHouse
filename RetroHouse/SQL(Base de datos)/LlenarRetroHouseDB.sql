-- Se le dice a sql que vamos a usar la base de datos retrohouse

-- USE retrohouse;

-- SELECT * FROM detalleventa;



-- DROP DATABASE retrohouse;

SELECT * FROM producto;

INSERT INTO rol (nombreRol) VALUES ('Administrador'),('Cliente'); -- Insertamos los roles

INSERT INTO categoria (nombreCategoria) VALUES ('Rock'),('Pop'),('Jazz'); -- Insertamos las categorias de los productos

-- Insertamos los prductos de Rock

INSERT INTO producto (nombreProducto,descripcion,cantidad,precio,imagen,musica,idCategoria,estado) VALUES ('Nevermind-Nirvana','Canciones de el álbum: 1.Smells like teen spirit - 2.In bloom - 3.Come as you are - 4.Breed - 5.Lithium - 6.Polly - 7.Territorial pissings - 8.Drain you - 9.Lounge act - 10.Stay away - 11.On a plain - 12.Something in the way',
5,300000,'nirvanaNevermind.jpg','nirvana-nevermind.mp3',1,1),
('At night at the opera-Queen ',"Canciones del álbum: 1.Love Of My Life - 2.Bohemian Rhapsody - 3.'39 - 4.God Save The Queen - 5.Lazing On A Sunday Afternoon - 6.Death On Two Legs - 7.Good Company - 8.I'm In Love With My Car - 9.Seaside Rendezvous - 10.You're My Best Friend - 11.The Prophet's Song - 12.Sweet Lady",
6,320000,'aNightAtTheOpera.jpg','a-night-at-the-opera.mp3',1,1),
('Black in black-ACDC',"Canciones del álbum: 1.Hells Bells - 2.Shoot to Thrill - 3.What Do You Do for Money Honey - 4.Givin the Dog a Bone - 5.Let Me Put My Love Into You - 6.Back in Black - 7.You Shook Me All Night Long - 8.Have a Drink on Me - 9.Shake a Leg - 10.Rock 'n' Roll Ain't Noise Pollution.",
8,280000,'acdcBlackInBlack.jpg','acdc-black-in-black.mp3',1,1),
('Queen II-Queen',"Canciones del álbum: 1.Procession» - 2.Father to Son - 3.White Queen (As It Began) - 4.Some Day One Day - 5.The Loser in the End	 - 6.Ogre Battle - 7.The Fairy Feller's Master-Stroke - 8.Nevermore  - 9.The March of the Black Queen - 10.Funny How Love Is - 11.Seven Seas Of Rhye",
4,290000,'queenII.jpg','Queen-queenII.mp3',1,1),
("Appetite For Destruction-Guns N' Roses","Canciones del álbum: 1.Welcome To The Jungle - 2.It's So Easy - 3.Nightrain - 4.Out Ta Get Me - 5.Mr. Brownstone - 6.Paradise City - 7.My Michelle - 8.Think About You - 9.Sweet Child O' Mine - 10.You're Crazy - 11.Anything Goes - 12.Rocket Queen",
9,275000,'Guns-N-Roses-Appetite-for-Destruction-LP.jpg','Gun-N-Roses-Appetite-for-Destruction.mp3',1,1),
('Blackout-Scorpions',"Canciones del álbum: 1.Blackout - 2.Can't Live Without You - 3.No One Like You - 4.You Give Me All I Need - 5.Now! - 6.Dynamite - 7.Arizona  - 8.China White - 9.When the Smoke Is Going Down",
4,289000,'scorpionsblackout.jpg','scorpions-blackout.mp3',1,1);

-- Insertamos los productos de Pop

INSERT INTO producto (nombreProducto,descripcion,cantidad,precio,imagen,musica,idCategoria,estado) VALUES ('Bad-Michael Jackson',"Canciones del álbum: 1.Bad - 2.The Way You Make Me Feel - 3.Speed Demon - 4.Liberian Girl - 5.Just Good Friends - 6.Another Part Of Me- 7.Man In The Mirror - 8.I Just Can’t Stop Loving You - 9.Dirty Diana - 10.Smooth Criminal - 11.Leave Me Alone",
4,335000,'michaelBad.jpg','MichaelJackson-Bad.mp3',2,1),
('Thriller-Michael Jackson',"Canciones del álbum: 1.Wanna Be Startin Somethin - 2.Baby Be Mine - 3.The Girl Is Mine - 4.Thriller - 5.Beat It - 6.Billie Jean - 7.Human Nature - 8.P.Y.T. (Pretty Young Thing) - 9.The Lady in My Life",
3,370000,'michaelThriller.jpg','MichaelJackson-Thriller.mp3',2,1),
('Gate Fold Jacket-Taylor Swift',"Canciones del álbum: 1.Willow - 2.Champagne Problems - 3.Gold Rush - 4.Tis The Damn Season - 5.Tolerate It - 6.No Body, No Crime - 7.Happiness - 8.Dorothea - 9.Coney Island - 10.Ivy - 11.Cowboy Like Me - 12.Long Story Short - 13.Marjorie - 14.Closure - 15.Evermore - 16.Right Where You Left Me - 17.It´s Time To Go",
3,300000,'taylorGatefoldJacket.jpg','willow.mp3',2,1),
('Midnights-Taylor Swift',"Canciones del álbum: 1.Lavender Haze - 2.Maroon - 3.Anti-Hero - 4.Snow On The Beach - 5.You´re On Your Own, Kid - 6.Midnight Rain - 7.Question…? - 8.Vigilante Shit - 9.Bejeweled - 10.Labyrinth - 11.Karma - 12.Sweet Nothing - 13.Mastermind",
4,290000,'taylorMidnights.jpg','LavenderHaze.mp3',2,1),
('Greatest Love Of All-Whitney Houston',"Canciones del álbum: 1.I Will Always Love You - 2.My Heart Will Go On - 3.You Raise Me Up - 4.Hero - 5.Take A Bow - 6.Careless Whisper - 7.I Turn To You - 8.Songbird - 9.How Am I Supposed To Live Without You",
6,280000,'whitneyGreatestLove.jpg','WhitneyHouston-GreatestLoveOfAll.mp3',2,1),
('I Wanna Dance-Whitney Houston',"Canciones del álbum: 1.I Wanna Dance With Somebody - 2.Just The Lonely Talking Again - 3.Didn´t We Almost Have It All - 4.Where you are  - 5.Love is a contact sport - 6.For the love of you  - 7.Where do broken hearts go - 8.I know him so well",
3,280000,'whitneyIWannaDance.jpg','WhitneyHouston-IWannaDanceWithSomebody.mp3',2,1);

-- Insertamos los productos de Jazz

INSERT INTO producto (nombreProducto,descripcion,cantidad,precio,imagen,musica,idCategoria,estado) VALUES ('Metro Jazz-Benny Goodman',"Canciones del álbum: 1.Chicago - 2.Madhouse - 3.I know that you know - 4.Swing low, Swee chariot",
2,350000,'bennyMetroJazz.jpg','BennyGoodman-MetroJazz.mp3',3,1),
('Study in Brown-Clifford Brown',"Canciones del álbum: 1.Cherokee - 2.Jacqui - 3.Swingin - 4.Lands End - 5.George's Dilemma - 6.Sandu - 7.Gerkin for Perkin - 8.If I Love Again - 9.Take the 'A' Train",
4,290000,'cliffordStudyinBrown.jpg','CliffordBrown-StudyinBrown.mp3',3,1),
('Swing Into Spring-Benny Goodman',"Canciones del álbum: 1.Introduction - 2.The Earl - 3.I'll Never Say 'Never Again' Again - 4.Undecided - 5.Just You, Just Me - 6.Perfidia - 7.Rachel's Dream - 8.What A Little Moonlight Can Do - 9.Slipped Disc - 10.La Rosita - 11.Take It - 12.Swing Into Spring",
3,320000,'bennySwingIntoSpring.jpg','BennyGoodman-SwingIntoSpring.mp3',3,1),
('Giant Steps-Jhon Coltrane',"Canciones del álbum: 1.Giant Steps - 2.Cousin Mary - 3.Countdown - 4.Spiral - 5.Syeeda's Song Flute - 6.Naima	 - 7.Mr. P. C ",
4,270000,'johnGiantSteps.jpg','JohnColtrane-GiantSteps.mp3',3,1),
('The Very Best Of Louis Armstrong 20 Golden Greats-Louis Armstrong',"Canciones del álbum: 1.What A Wonderful World - 2.Hello Dolly - 3.Basin St. Blues - 4.Gone Fishin' - 5.Cabaret - 6.A Kiss To Build A Dream On - 7.Faithful Hussar - 8.Blueberry Hill - 9.Ain't Misbehavin' - 10.Rockin' Chair - 11.Mack The Knife - 12.When The Saints Go 13.Marching In - 14.Takes Two To Tango - 15.Sunshine Of Love - 16.Easy Street - 17.Muskrat Ramble - 18.Black And Blue - 19.Pennies From Heaven - 20.St. Louis Blues - 21.When It's Sleepy Time Down South",
5,380000,'louisarmastrong20goldengreats.jpg','LouisAmstrong-20gold.mp3',3,1),
('A Love Supreme-Jhon Coltrane',"Canciones del álbum: 1.Acknowledgement - 2.Resolution - 3.Pursuance - 4.Psalm",
6,295000,'johnColtraneALoveSupreme.jpg','johnColtrane-ALoveSupreme.mp3',3,1);

-- Creamos el primer administrador y su clave es Admin123

INSERT INTO  usuario (documentoCliente,nombreCompleto,direccion,celular,email,idRol,`password`,ciudad,imagenPerfil,estado) VALUES ('1000536055','Jose Manuel Gallego Carvajal','Carrera 70 # 90 - 60','3177342311','admin@gmail.com',1,'$2y$10$rabK5T422lofdSZnqvWJNOCcpR93hlOAwKU1vRslVwJQzNtGDTJIi','Medellín','',1); 

-- Creamos el primer proveedor 

INSERT INTO proveedor (nombreProveedor,correoProveedor,telefonoProveedor,estado) VALUES ("Antonio","antonete@gmail.com","12345678910",1);

-- Llenamos la tabla estadoCarrito

INSERT INTO `estadoCarrito` (`id`, `descripcion`) VALUES
(1, 'Agregado'),
(2, 'Descartado'),
(3, 'Comprado');

-- Llenamos la tabla estado venta

INSERT INTO `estadoVenta` (`id`, `descripción`) VALUES
(1, 'En espera'),
(2, 'Denegado'),
(3, 'Aceptado');