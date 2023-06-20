INSERT INTO
    `users_table` (
        `id`,
        `username`,
        `full_name`,
        `email`,
        `phone_number`,
        `password`,
        `profile_picture_path`,
        `display_name`,
        `bio`,
        `created_at`
    )
VALUES
    (
        462,
        'alexrodriguez',
        'Alex Rodriguez',
        'alexrodriguez@example.com',
        '716738183',
        '$2y$10$sNIp7/QUGoxQnybP/AO/8.Eclx1fN/uxJwpNqrKuD.lf7dGLF3zEe',
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032647/momento/profile-pictures/6476cbf3de953_6473372d1ee85_stephan-louis-MBTU3KoDZ94-unsplash_qdv6kg.jpg',
        'Alex Rodriguez',
        '- Fitness & Car Lover\r\n- Passionate about health and horsepower \r\n- Join me on the ride! #FitnessCars',
        '2023-06-18 15:54:02'
    ),
    (
        463,
        'oliviathompson',
        'Olivia Thompson',
        'oliviathompson@example.com',
        '77643819',
        '$2y$10$pQAbdDoESs10UbzAsNKEIOUlDqXXip8Ab9cIBGw/e5HfeUPyg.zw.',
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032647/momento/profile-pictures/6476cc4f297c4_6475e8eb14ab4_647339895169b_646e3e94c93a4_raul-angel-x8Ac6jee_3s-unsplash_ts8vht.jpg',
        'Olivia Thompson',
        'Music lover | Foodie | Fashion enthusiast | NYC 🎧🍕👗',
        '2023-06-18 15:54:02'
    ),
    (
        464,
        'mikeanderson',
        'Mike Anderson',
        'mikeanderson@example.com',
        '946257812',
        '$2y$10$r00YkOSJuQC.OeeISIBZjO1cefHttqQGtpgEeL2EvXDCVnnuydGBO',
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032647/momento/profile-pictures/6476cc059acd8_64733c35a70ef_ashton-bingham-EQFtEzJGERg-unsplash_iipwrc.jpg',
        'Mike Anderson',
        'Capturing life\'s vibrant moments. Art, travel, and coffee fuel my adventures. #Photographer #Painter #Traveler',
        '2023-06-18 15:54:02'
    ),
    (
        465,
        'emilywilson',
        'Emily Wilson',
        'emilywilson@example.com',
        '6784186461',
        '$2y$10$67OsumNDldspfYnirtOnpOKfGlSV2JRveJvbAVkJk4q/WfqbYH8fm',
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032647/momento/profile-pictures/6476cbd89323e_6475d9fd5557a_64733cdeed898_646d4e69d801f_andi-rieger-NRA1637A4Tc-unsplash_g1ewif.jpg',
        'Emily Wilson',
        'Passionate about cultivating a healthy lifestyle and inner balance. Embarking on thrilling treks and inspiring others to embrace wellness.',
        '2023-06-18 15:54:02'
    ),
    (
        469,
        'davidcooper',
        'David Cooper',
        'davidcooper@example.com',
        '998164513',
        '$2y$10$0jdJLaDhsBMr.03bmNS58OL/DeLeuTzzX/PdL1g4d36/f2AbIePj6',
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032647/momento/profile-pictures/6476cc191e8f5_647369b0e1499_manas-taneja-e6mfL8_i9aQ-unsplash_v4fzfn.jpg',
        'David Cooper',
        'Guitarist and football lover. Sharing my passion for music and the beautiful game. Let\'s connect and create amazing moments! 🎸⚽',
        '2023-06-18 15:54:02'
    ),
    (
        470,
        'sophiaadams',
        'Sophia Adams',
        'sophiaadams@example.com',
        '778164511',
        '$2y$10$2.NdctRewJkxaGDs9R8r.O1O7Jr/N9/1v0647urFv0/w5wTYZlRwe',
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032646/momento/profile-pictures/6476cc2be1db6_6473638f48bd6_646e6f0f4aadf_aiony-haust-f2ar0ltTvaI-unsplash_ihopvo.jpg',
        'Sophia Adams',
        '📸 Capturing moments | 🌍 Exploring the world | 📚 One book at a time',
        '2023-06-18 15:54:02'
    );

INSERT INTO
    `posts_table` (
        `id`,
        `user_id`,
        `image_dir`,
        `caption`,
        `created_at`,
        `updated_at`
    )
VALUES
    (
        113,
        464,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032837/momento/posts/6476ce0208acf_64736461c0826_647227bf5500f_andres-prieto-molina-ytLljskLEQc-unsplash_gxjz3p.jpg',
        'Just completed building my new drone! It\'s all set and ready! Any recommendations on breathtaking locations for capturing amazing shots? 🌍📸 #DronePhotography #AdventureAwaits',
        '2023-05-28 14:25:37',
        '2023-05-31 06:33:06'
    ),
    (
        114,
        470,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032842/momento/posts/6476d04665426_6473659ed9e67_nong-9pw4TKvT3po-unsplash_kc1pma.jpg',
        'Unlocking the mysteries of the night with words, now I can read in the dark! 🌙📚',
        '2023-05-28 14:30:54',
        '2023-05-31 06:42:46'
    ),
    (
        115,
        465,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032839/momento/posts/6476cfc93a46d_647366e9dfa33_ellicia-4xNDhf0nA-Y-unsplash_afx4bf.jpg',
        'A delightful encounter with nature\'s cuddliest ambassador at the zoo! 🐨✨ #KoalaCuteness',
        '2023-05-28 14:36:25',
        '2023-05-31 06:40:41'
    ),
    (
        116,
        462,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032838/momento/posts/6476ced7a96d7_647367b82ec25_jason-leung-3yllkHDQkus-unsplash_mbk9xy.jpg',
        'Cruisin\' through the car show in Manhattan 🚗📸 #CarEnthusiast #AutoShowcase',
        '2023-05-28 14:39:52',
        '2023-05-31 06:36:39'
    ),
    (
        117,
        463,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032841/momento/posts/6476d0a862310_6473694163d7f_marc-chong-FwOok-7ao8Y-unsplash_atwhui.jpg',
        'Immersed in the city\'s energy, enjoying the vibrant NYC vibes! 🌆🌟 #CityLife #NewYorkCity',
        '2023-05-28 14:43:07',
        '2023-05-31 06:44:24'
    ),
    (
        118,
        469,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032840/momento/posts/6476cf2c93262_64731f2d0a208_parker-coffman-GgsG8aNLgjQ-unsplash_vrfa9o.jpg',
        'Playing my guitar, filling the air with music. 🎶🎸',
        '2023-05-28 14:49:32',
        '2023-05-31 06:38:04'
    ),
    (
        119,
        470,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032840/momento/posts/6476cfff079d5_64736b1c65629_kevin-schmid_-_kTgps7o15g-unsplash_w0sbck.jpg',
        'Embracing the snowy charm of Zermatt from inside the iconic red train ❄️🚂❄️',
        '2023-05-28 14:54:20',
        '2023-05-31 06:41:35'
    ),
    (
        121,
        464,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032837/momento/posts/6476cdd054236_6473701ee7590_rumman-amin-GA1g1FVzaes-unsplash_njqoz4.jpg',
        'Lost in the colors of Positano, where every corner tells a story of beauty and charm. 🇮🇹💙☀️ #PositanoDreams #ItalianEscape',
        '2023-05-28 15:15:03',
        '2023-05-31 06:32:16'
    ),
    (
        122,
        462,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032837/momento/posts/6476cec045241_647371a58cea0_morgan-rovang-t38nvd1DF3o-unsplash_sd0wew.jpg',
        'Unleashing the spirit of adventure amidst the majestic mountains of Silverton.',
        '2023-05-28 15:22:13',
        '2023-05-31 06:36:16'
    ),
    (
        123,
        465,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032839/momento/posts/6476cfb0df5e0_64737335c608e_646dd1e6b3728_adam-freeman-r-1fwyoCcZI-unsplash_tkebbc.jpg',
        'Exploring the great outdoors on an epic trekking adventure. Every step reveals new wonders and unforgettable experiences. #TrekkingLife #NatureExploration',
        '2023-05-28 15:28:53',
        '2023-06-18 14:23:07'
    ),
    (
        124,
        469,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032839/momento/posts/6476cf1e9f4f1_6473245e6fa5b_colin-lloyd-SplXzxtv6AI-unsplash_sm02e4.jpg',
        'Immersed in the music, surrounded by joy! 🎶🎉 #MusicFestivalVibes',
        '2023-05-28 15:29:52',
        '2023-05-31 06:37:50'
    ),
    (
        125,
        463,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032842/momento/posts/6476d0994e0a0_6473742bdf012_kayleigh-harrington-yhn4okt6ci0-unsplash_kwaymc.jpg',
        'Indulging in a delightful dining experience at my favorite restaurant. Bon appétit! 🍽️✨ #CulinaryDelights #FoodieAdventures\"',
        '2023-05-28 15:32:59',
        '2023-05-31 06:44:09'
    ),
    (
        126,
        470,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032841/momento/posts/6476cff2b1309_64731f5a97b33_toms-rits-ryfptJi3fAM-unsplash_siyf5x.jpg',
        'Embarking on an Adventure: Our Caravan Getaway Begins! 🚐✨',
        '2023-05-28 15:34:19',
        '2023-05-31 06:41:22'
    ),
    (
        127,
        464,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032836/momento/posts/6476cd9604bfa_64737618eb234_ashim-d-silva-h8b1T39sm2w-unsplash_cnumld.jpg',
        'Throwing it back to the wild and untamed beauty of Africa, where breathtaking landscapes and unforgettable memories were captured along the open road. 🌍🚐',
        '2023-05-28 15:41:12',
        '2023-05-31 06:31:18'
    ),
    (
        128,
        469,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032838/momento/posts/6476cefca5f41_6475da1e3fc9c_64731ea897fbe_fancy-crave-qowyMze7jqg-unsplash_eweun7.jpg',
        'Spectating tonight\'s match in England! Who\'s your team? ⚽',
        '2023-05-28 15:42:04',
        '2023-05-31 06:37:16'
    ),
    (
        129,
        462,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032837/momento/posts/6476cea76a5f6_647376f172804_guillaume-briard-l2hEOM38Hts-unsplash_e74440.jpg',
        'Balancing on the edge of possibility, conquering mountains and pushing beyond limits. Embrace the thrill of reaching new heights with me. 🏔️✨ #MountainAdventures #LimitlessJourney',
        '2023-05-28 15:44:49',
        '2023-05-31 06:35:51'
    ),
    (
        131,
        465,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032839/momento/posts/6476cf6a4383e_64737d097e7b1_nicole-herrero-rWWLpxSefp8-unsplash_av5z6p.jpg',
        'Gathering around a bountiful feast with cherished friends. Laughter, stories, and delicious moments shared. Grateful for these beautiful connections. 🍽️❤️🥂',
        '2023-05-28 16:01:40',
        '2023-05-31 06:39:06'
    ),
    (
        132,
        463,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032843/momento/posts/6476d0893dcc3_64737cd0ba37f_annie-spratt-CWOA-njJBjE-unsplash_gk89oa.jpg',
        'Captivated by the lively Berber market, where vibrant colors and rich culture come alive. Cherishing the memories and treasures found in every corner. 🌺🇲🇦 #BerberMarket #MoroccanVibes',
        '2023-05-28 16:07:17',
        '2023-05-31 06:43:53'
    ),
    (
        133,
        470,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032840/momento/posts/6476cfe3c8b17_64737d4d86c2a_adriana-apostol-JhwwPzzh100-unsplash_ljcont.jpg',
        'Lost in the enchanting world of Cărturești Carusel, where imagination takes flight. A mesmerizing encounter with the giant blue ball, a symbol of our vast and beautiful planet. 🌍💙 #CărtureștiCarusel #BucharestAdventures',
        '2023-05-28 16:11:57',
        '2023-06-18 15:52:01'
    ),
    (
        134,
        464,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032836/momento/posts/6476cd7f88a7d_64737eee43f7b_jake-irish-NZBIaOMYJbY-unsplash_nxjhyk.jpg',
        'Missing the unforgettable night we spent camping in an Airstream at the stunning Salar de Uyuni, Bolivia. Reminiscing about the surreal beauty of the salt flats and the joy of starry nights. 🏕️✨ #ThrowbackMemories #BolivianAdventures',
        '2023-05-28 16:18:54',
        '2023-05-31 06:30:55'
    ),
    (
        135,
        469,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032838/momento/posts/6476cef40502b_64737fb90646a_kenny-eliason-PpXcJ9tDBBY-unsplash_dhwnr0.jpg',
        'Last weekend, my band and I took the stage by storm, filling the air with electrifying guitar solos and pulsating beats. The energy was contagious, creating an unforgettable musical journey. 🎸🎶 #BandLife #WeekendVibes',
        '2023-05-28 16:22:17',
        '2023-05-31 06:37:08'
    ),
    (
        136,
        465,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032837/momento/posts/647fbbe336b6c_6476cf4aac45b_647382ff5e1f8_alora-griffiths-mTJx6HeORCI-unsplash_xasfgn.jpg',
        'Couldn\'t resist capturing the charm of Toronto\'s urban vibe. Just had to stop and take in the cityscape before diving into the day. 📸',
        '2023-05-28 16:33:33',
        '2023-06-18 14:23:00'
    ),
    (
        137,
        463,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032841/momento/posts/6476d07a4bb96_647384231bf80_tom-ritson-14-jJXWXUys-unsplash-min_jivejp.jpg',
        'Love the vibrant chaos of NYC streets 🌃',
        '2023-05-28 16:41:07',
        '2023-05-31 06:43:38'
    ),
    (
        139,
        462,
        'https://res.cloudinary.com/dp4vwqhol/image/upload/v1687032837/momento/posts/6476ce1b16f17_6473cd1189858_tim-trad-Ur5VN_92g-k-unsplash_xjbzqi.jpg',
        'Capturing the excitement of the Daytona 500! 🏁🔥 #Daytona500 #MemorableMoments',
        '2023-05-28 16:46:46',
        '2023-05-31 06:33:31'
    );

INSERT INTO
    `likes_table` (`like_id`, `liker_id`, `post_id`, `liked_at`)
VALUES
    (267, 470, 139, '2023-06-18 15:53:02'),
    (268, 470, 137, '2023-06-18 15:53:02'),
    (273, 465, 134, '2023-06-18 15:53:02'),
    (277, 464, 131, '2023-06-18 15:53:02'),
    (290, 464, 139, '2023-06-18 15:53:02'),
    (291, 464, 137, '2023-06-18 15:53:02'),
    (293, 465, 131, '2023-06-18 15:53:02'),
    (300, 465, 137, '2023-06-18 15:53:02'),
    (301, 465, 136, '2023-06-18 15:53:02'),
    (303, 465, 135, '2023-06-18 15:53:02'),
    (306, 465, 132, '2023-06-18 15:53:02'),
    (307, 465, 139, '2023-06-18 15:53:02'),
    (309, 465, 128, '2023-06-18 15:53:02'),
    (310, 465, 123, '2023-06-18 15:53:02'),
    (311, 462, 139, '2023-06-18 15:53:02'),
    (312, 464, 134, '2023-06-18 15:53:02'),
    (313, 464, 136, '2023-06-18 15:53:02'),
    (314, 464, 133, '2023-06-18 15:53:02'),
    (315, 464, 122, '2023-06-18 15:53:02'),
    (316, 464, 121, '2023-06-18 15:53:02'),
    (317, 465, 116, '2023-06-18 15:53:02'),
    (318, 465, 125, '2023-06-18 15:53:02'),
    (319, 465, 127, '2023-06-18 15:53:02'),
    (320, 463, 139, '2023-06-18 15:53:02'),
    (321, 463, 126, '2023-06-18 15:53:02'),
    (322, 463, 133, '2023-06-18 15:53:02'),
    (323, 463, 119, '2023-06-18 15:53:02'),
    (324, 463, 114, '2023-06-18 15:53:02'),
    (325, 463, 136, '2023-06-18 15:53:02'),
    (326, 463, 134, '2023-06-18 15:53:02'),
    (327, 463, 129, '2023-06-18 15:53:02'),
    (328, 463, 127, '2023-06-18 15:53:02'),
    (329, 463, 137, '2023-06-18 15:53:02'),
    (330, 463, 135, '2023-06-18 15:53:02'),
    (331, 463, 124, '2023-06-18 15:53:02'),
    (332, 463, 123, '2023-06-18 15:53:02'),
    (333, 463, 122, '2023-06-18 15:53:02'),
    (334, 463, 121, '2023-06-18 15:53:02'),
    (335, 463, 118, '2023-06-18 15:53:02'),
    (336, 463, 116, '2023-06-18 15:53:02'),
    (337, 463, 113, '2023-06-18 15:53:02'),
    (338, 469, 139, '2023-06-18 15:53:02'),
    (339, 469, 136, '2023-06-18 15:53:02'),
    (340, 469, 134, '2023-06-18 15:53:02'),
    (341, 469, 133, '2023-06-18 15:53:02'),
    (342, 469, 131, '2023-06-18 15:53:02'),
    (343, 469, 129, '2023-06-18 15:53:02'),
    (344, 469, 128, '2023-06-18 15:53:02'),
    (345, 469, 127, '2023-06-18 15:53:02'),
    (346, 469, 126, '2023-06-18 15:53:02'),
    (347, 469, 125, '2023-06-18 15:53:02'),
    (348, 469, 123, '2023-06-18 15:53:02'),
    (349, 469, 121, '2023-06-18 15:53:02'),
    (350, 469, 119, '2023-06-18 15:53:02'),
    (351, 469, 117, '2023-06-18 15:53:02'),
    (352, 469, 116, '2023-06-18 15:53:02'),
    (353, 469, 115, '2023-06-18 15:53:02'),
    (354, 469, 114, '2023-06-18 15:53:02'),
    (355, 469, 113, '2023-06-18 15:53:02'),
    (356, 469, 135, '2023-06-18 15:53:02'),
    (357, 469, 124, '2023-06-18 15:53:02'),
    (358, 469, 118, '2023-06-18 15:53:02'),
    (359, 469, 137, '2023-06-18 15:53:02'),
    (360, 469, 132, '2023-06-18 15:53:02'),
    (361, 465, 122, '2023-06-18 15:53:02'),
    (362, 465, 115, '2023-06-18 15:53:02'),
    (363, 465, 133, '2023-06-18 15:53:02'),
    (364, 465, 124, '2023-06-18 15:53:02'),
    (365, 465, 113, '2023-06-18 15:53:02'),
    (366, 465, 129, '2023-06-18 15:53:02'),
    (367, 465, 114, '2023-06-18 15:53:02'),
    (368, 465, 126, '2023-06-18 15:53:02'),
    (369, 470, 134, '2023-06-18 15:53:02'),
    (370, 470, 127, '2023-06-18 15:53:02'),
    (371, 470, 133, '2023-06-18 15:53:02'),
    (372, 470, 126, '2023-06-18 15:53:02');