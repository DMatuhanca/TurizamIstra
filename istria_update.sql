USE istria;

UPDATE cities SET 
  description = 'Rovinj je jedan od najfotogeničnijih gradova na Jadranu, poznat po pastelno obojenim kućama, uskim kaletama i panorami s crkvom sv. Eufemije. Stari grad smješten je na poluotoku, a okružuju ga mirne uvale i borove šume.',
  attractions = '• Uspon do crkve sv. Eufemije i vidikovca\n• Šetnja starom jezgrom i Balbijevim lukom\n• Vožnja brodom do Crvenog otoka\n• Kupanje na plažama Škaraba i Lone'
WHERE name='Rovinj';

UPDATE cities SET 
  description = 'Pula je najveći istarski grad i antički biser čiji je simbol rimska Arena iz 1. stoljeća. Grad spaja antičku baštinu, austro-ugarsku arhitekturu i suvremenu kulturu, a okružuju ga predivne plaže i prirodne uvale.',
  attractions = '• Razgled Arene i podzemnih hodnika\n• Slavoluk Sergijevaca i Augustov hram\n• Šetnja po Verudeli i Lungomare\n• Medulin i Premantura u blizini'
WHERE name='Pula Arena';

UPDATE cities SET 
  description = 'Nacionalni park Brijuni obuhvaća 14 otoka s bogatom povijesti, arheološkim nalazištima i iznimnom mediteranskom florom i faunom. Idealno za jednodnevne izlete i bicikliranje.',
  attractions = '• Obilazak Velog Brijuna turističkim vlakićem\n• Posjet safari parku i arheološkim lokalitetima\n• Najam bicikla i istraživanje uvala'
WHERE name='Brijuni';

UPDATE cities SET 
  description = 'Motovun je srednjovjekovni grad na brežuljku s pogledom na dolinu Mirne i Motovunsku šumu – svjetski poznato stanište tartufa. Uske kalete, gradske zidine i vinski podrumi stvaraju poseban doživljaj Istre.',
  attractions = '• Šetnja zidinama i uživanje u pogledu\n• Degustacija tartufa i lokalnih vina\n• Vožnja Parenzanom (biciklistička staza)'
WHERE name='Motovun';

UPDATE cities SET 
  description = 'Poreč je grad bogate povijesti i kulture čiju jezgru krasi Eufrazijeva bazilika pod zaštitom UNESCO-a. Uz povijesne znamenitosti, nudi uređene plaže, šetnice i zabavnu ponudu.',
  attractions = '• Eufrazijeva bazilika i mozaici\n• Šetnja Decumanusom i Maraforom\n• Izlet do Zelene i Plave lagune'
WHERE name='Poreč';

UPDATE cities SET 
  description = 'Rt Kamenjak je zaštićeni krajobraz na samom jugu Istre – poznat po dramatičnim stijenama, skrivenim uvalama i kristalno čistom moru. Odličan za kupanje, ronjenje i lagane trekinge.',
  attractions = '• Skakanje sa stijena i snorklanje\n• Šetnja označenim stazama i vidikovcima\n• Safari bar i plaže pod borovima'
WHERE name='Rt Kamenjak';


DROP TABLE IF EXISTS city_images;
CREATE TABLE city_images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  city_id INT NOT NULL,
  image VARCHAR(255) NOT NULL,
  alt_text VARCHAR(255) DEFAULT NULL,
  FOREIGN KEY (city_id) REFERENCES cities(id) ON DELETE CASCADE
);

INSERT INTO city_images (city_id, image, alt_text) VALUES
(1,'rovinj1.jpg','Rovinj stara jezgra'),
(1,'rovinj2.jpg','Pogled s rive'),
(1,'rovinj3.jpg','Crkva sv. Eufemije');

INSERT INTO city_images (city_id, image, alt_text) VALUES
(2,'pula1.jpg','Arena eksterijer'),
(2,'pula2.jpg','Arena interijer'),
(2,'pula3.jpg','Centar Pule');

INSERT INTO city_images (city_id, image, alt_text) VALUES
(3,'brijuni1.jpg','Uvala na Brijunima'),
(3,'brijuni2.jpg','Safari park'),
(3,'brijuni3.jpg','Arheološki lokalitet');

INSERT INTO city_images (city_id, image, alt_text) VALUES
(4,'motovun1.jpg','Motovun panorama'),
(4,'motovun2.jpg','Gradske zidine'),
(4,'motovun3.jpg','Motovunska šuma');

INSERT INTO city_images (city_id, image, alt_text) VALUES
(5,'porec1.jpg','Bazilika'),
(5,'porec2.jpg','Stari grad'),
(5,'porec3.jpg','Luka Poreč');

INSERT INTO city_images (city_id, image, alt_text) VALUES
(6,'kamenjak1.jpg','Stijene i more'),
(6,'kamenjak2.jpg','Uvala'),
(6,'kamenjak3.jpg','Staza uz obalu');
