<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DzikirController extends Controller
{
    public function index($waktu = 'pagi')
    {
        if (!in_array($waktu, ['pagi', 'petang'])) {
            abort(404);
        }

        $isPagi = $waktu === 'pagi';

        // ======================
        // BAC AAN UMUM (KUBRA)
        // ======================
        $bacaanUmum = [
            [
                'title' => 'Ta’awudz & Basmalah',
                'arabic' => 'أَعُوذُ بِاللّٰهِ مِنَ الشَّيْطَانِ الرَّجِيمِ\nبِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ',
                'latin' => 'A‘uudzu billaahi minasy syaithaanir rajiim. Bismillaahir rahmaanir rahiim.',
                'translation' => 'Aku berlindung kepada Allah dari godaan setan yang terkutuk. Dengan nama Allah Yang Maha Pengasih lagi Maha Penyayang.',
                'repeat' => 1
            ],
            [
                'title' => 'Al-Fatihah',
                'arabic' => 'بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ ۝ اَلْحَمْدُ لِلّٰهِ رَبِّ الْعٰلَمِيْنَۙ ۝ الرَّحْمٰنِ الرَّحِيْمِۙ ۝ مٰلِكِ يَوْمِ الدِّيْنِۗ ۝ اِيَّاكَ نَعْبُدُ وَاِيَّاكَ نَسْتَعِيْنُۗ ۝ اِهْدِنَا الصِّرَاطَ الْمُسْتَقِيْمَۙ ۝ صِرَاطَ الَّذِيْنَ اَنْعَمْتَ عَلَيْهِمْ ەۙ غَيْرِ الْمَغْضُوْبِ عَلَيْهِمْ وَلَا الضَّآلِّيْنَ ۝',
                'latin' => 'Bismillaahir rahmaanir rahiim. Alhamdulillaahi rabbil ‘aalamiin. Ar-rahmaanir rahiim. Maaliki yaumid diin. Iyyaaka na’budu wa iyyaaka nasta’iin. Ihdinash shiraathal mustaqiim. Shiraathalladziina an’amta ‘alaihim ghairil maghdhuubi ‘alaihim waladh-dhaalliin.',
                'translation' => 'Dengan nama Allah Yang Maha Pengasih lagi Maha Penyayang. Segala puji bagi Allah, Tuhan semesta alam. Yang Maha Pengasih lagi Maha Penyayang. Pemilik hari pembalasan. Hanya kepada Engkaulah kami menyembah dan hanya kepada Engkaulah kami memohon pertolongan. Bimbinglah kami ke jalan yang lurus. (Yaitu) jalan orang-orang yang telah Engkau beri nikmat, bukan (jalan) mereka yang dimurkai dan bukan (pula jalan) mereka yang sesat.',
                'repeat' => 1
            ],
            [
                'title' => 'Al-Baqarah 1–5',
                'arabic' => 'بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ ۝ الۤمّۤ ۚ ۝ ذٰلِكَ الْكِتٰبُ لَا رَيْبَ ۛ فِيْهِ ۛ هُدًى لِّلْمُتَّقِيْنَۙ ۝ الَّذِيْنَ يُؤْمِنُوْنَ بِالْغَيْبِ وَيُقِيْمُوْنَ الصَّلٰوةَ وَمِمَّا رَزَقْنٰهُمْ يُنْفِقُوْنَ ۙ ۝ وَالَّذِيْنَ يُؤْمِنُوْنَ بِمَآ اُنْزِلَ اِلَيْكَ وَمَآ اُنْزِلَ مِنْ قَبْلِكَ ۚ وَبِالْاٰخِرَةِ هُمْ يُوْقِنُوْنَۗ۝ اُولٰۤىِٕكَ عَلٰى هُدًى مِّنْ رَّبِّهِمْ ۙ وَاُولٰۤىِٕكَ هُمُ الْمُفْلِحُوْنَ ۝',
                'latin' => 'Alif-laam-miim. Dzaalikal kitaabu laa raiba fiihi hudal lil muttaqiin. Alladziina yu’minuuna bil ghaibi wa yuqiimuunash shalaata wa mimmaa razaqnaahum yunfiquun. Walladziina yu’minuuna bimaa unzila ilaika wa maa unzila min qablika wa bil aakhirati hum yuuqinuun. Ulaa-ika ‘alaa hudam mir rabbihim wa ulaa-ika humul muflihuun.',
                'translation' => 'Alif Lam Mim. Kitab (Al-Qur’an) ini tidak ada keraguan padanya; petunjuk bagi mereka yang bertakwa. (Yaitu) mereka yang beriman kepada yang gaib, melaksanakan salat, dan menginfakkan sebagian rezeki yang Kami berikan kepada mereka. Dan mereka yang beriman kepada (Al-Qur’an) yang diturunkan kepadamu (Muhammad) dan (kitab-kitab) yang telah diturunkan sebelum engkau, dan mereka yakin akan adanya akhirat. Merekalah yang mendapat petunjuk dari Tuhannya, dan mereka itulah orang-orang yang beruntung.',
                'repeat' => 1
            ],
            [
                'title' => 'Ayat Kursi',
                'arabic' => 'اَللّٰهُ لَآ اِلٰهَ اِلَّا هُوَۚ اَلْحَيُّ الْقَيُّوْمُ ەۚ لَا تَأْخُذُهٗ سِنَةٌ وَّلَا نَوْمٌۗ لَهٗ مَا فِى السَّمٰوٰتِ وَمَا فِى الْاَرْضِۗ مَنْ ذَا الَّذِيْ يَشْفَعُ عِنْدَهٗٓ اِلَّا بِاِذْنِهٖۗ يَعْلَمُ مَا بَيْنَ اَيْدِيْهِمْ وَمَا خَلْفَهُمْۚ وَلَا يُحِيْطُوْنَ بِشَيْءٍ مِّنْ عِلْمِهٖٓ اِلَّا بِمَا شَاۤءَۚ وَسِعَ كُرْسِيُّهُ السَّمٰوٰتِ وَالْاَرْضَۚ وَلَا يَـُٔوْدُهٗ حِفْظُهُمَاۚ وَهُوَ الْعَلِيُّ الْعَظِيْمُ ۝ لَآ اِكْرَاهَ فِى الدِّيْنِۗ قَدْ تَّبَيَّنَ الرُّشْدُ مِنَ الْغَيِّ ۚ فَمَنْ يَّكْفُرْ بِالطَّاغُوْتِ وَيُؤْمِنْۢ بِاللّٰهِ فَقَدِ اسْتَمْسَكَ بِالْعُرْوَةِ الْوُثْقٰى لَا انْفِصَامَ لَهَا ۗوَاللّٰهُ سَمِيْعٌ عَلِيْمٌ ۝ اَللّٰهُ وَلِيُّ الَّذِيْنَ اٰمَنُوْا يُخْرِجُهُمْ مِّنَ الظُّلُمٰتِ اِلَى النُّوْرِۗ وَالَّذِيْنَ كَفَرُوْٓا اَوْلِيَاۤؤُهُمُ الطَّاغُوْتُ يُخْرِجُوْنَهُمْ مِّنَ النُّوْرِ اِلَى الظُّلُمٰتِۗ اُولٰۤىِٕكَ اَصْحٰبُ النَّارِۚ هُمْ فِيْهَا خٰلِدُوْنَ',
                'latin' => 'Allaahu laa ilaaha illaa huwal hayyul qayyuum...',
                'translation' => 'Allah, tidak ada Tuhan yang berhak disembah selain Dia...',
                'repeat' => 1
            ],
            [
                'title' => 'Al-Baqarah 284–286',
                'arabic' => 'لِلّٰهِ مَا فِى السَّمٰوٰتِ وَمَا فِى الْاَرْضِ ۗ وَاِنْ تُبْدُوْا مَا فِيْٓ اَنْفُسِكُمْ اَوْ تُخْفُوْهُ يُحَاسِبْكُمْ بِهِ اللّٰهُ ۗ فَيَغْفِرُ لِمَنْ يَّشَاۤءُ وَيُعَذِّبُ مَنْ يَّشَاۤءُ ۗ وَاللّٰهُ عَلٰى كُلِّ شَيْءٍ قَدِيْرٌ ۝ اٰمَنَ الرَّسُوْلُ بِمَآ اُنْزِلَ اِلَيْهِ مِنْ رَّبِّهٖ وَالْمُؤْمِنُوْنَۗ كُلٌّ اٰمَنَ بِاللّٰهِ وَمَلٰۤىِٕكَتِهٖ وَكُتُبِهٖ وَرُسُلِهٖۗ لَا نُفَرِّقُ بَيْنَ اَحَدٍ مِّنْ رُّسُلِهٖ ۗ وَقَالُوْا سَمِعْنَا وَاَطَعْنَا غُفْرَانَكَ رَبَّنَا وَاِلَيْكَ الْمَصِيْرُ ۝ لَا يُكَلِّفُ اللّٰهُ نَفْسًا اِلَّا وُسْعَهَا ۗ لَهَا مَا كَسَبَتْ وَعَلَيْهَا مَا اكْتَسَبَتْ ۗ رَبَّنَا لَا تُؤَاخِذْنَآ اِنْ نَّسِيْنَآ اَوْ اَخْطَأْنَا ۚ رَبَّنَا وَلَا تَحْمِلْ عَلَيْنَآ اِصْرًا كَمَا حَمَلْتَهٗ عَلَى الَّذِيْنَ مِنْ قَبْلِنَا ۚ رَبَّنَا وَلَا تُحَمِّلْنَا مَا لَا طَاقَةَ لَنَا بِهٖۚ وَاعْفُ عَنَّاۗ وَاغْفِرْ لَنَاۗ وَارْحَمْنَا ۗ اَنْتَ مَوْلٰىنَا فَانْصُرْنَا عَلَى الْقَوْمِ الْكٰفِرِيْنَ ۝',
                'latin' => 'Lillaahi maa fis samaawaati wa maa fil ardh. Wa in tubduu maa fii anfusikum au tukhfuuhu yuhaasibkum bihillah. Fayaghfiru limay yasyaa-u wa yu’adzdzibu may yasyaa-u wallaahu ‘alaa kulli syai-in qadiir. Aamanar rasuulu bimaa unzila ilaihi mir rabbihii wal mu’minuun. Kullun aamana billaahi wa malaa-ikatihii wa kutubihii wa rusulih. Laa nufarriqu baina ahadim mir rusulih. Wa qaaluu sami’naa wa atha’naa ghufraanaka rabbanaa wa ilaikal mashiir. Laa yukallifullaahu nafsan illaa wus’ahaa lahaa maa kasabat wa ‘alaihaa maktasabat. Rabbanaa laa tu-aakhidznaa in nasiinaa au akhtha’naa. Rabbanaa wa laa tahmil ‘alainaa ishran kamaa hamaltahuu ‘alal ladziina min qablinaa. Rabbanaa wa laa tuhammilnaa maa laa thaaqata lanaa bih. Wa’fu ‘annaa waghfir lanaa warhamnaa anta maulaanaa fanshurnaa ‘alal qaumil kaafiriin.',
                'translation' => 'Milik Allah-lah apa yang ada di langit dan apa yang ada di bumi. Jika kamu nyatakan apa yang ada di dalam hatimu atau kamu sembunyikan, niscaya Allah memperhitungkannya bagimu. Dia mengampuni siapa yang Dia kehendaki dan menyiksa siapa yang Dia kehendaki. Allah Mahakuasa atas segala sesuatu. Rasul (Muhammad) beriman kepada apa yang diturunkan kepadanya (Al-Qur’an) dari Tuhannya, demikian pula orang-orang yang beriman. Semua beriman kepada Allah, malaikat-malaikat-Nya, kitab-kitab-Nya dan rasul-rasul-Nya. (Mereka berkata), “Kami tidak membeda-bedakan seorang pun dari rasul-rasul-Nya.” Dan mereka berkata, “Kami dengar dan kami taat. Ampunilah kami, ya Tuhan kami, dan kepada-Mu tempat kembali.” Allah tidak membebani seseorang melainkan sesuai dengan kesanggupannya. Ia mendapat pahala (dari kebajikan) yang diusahakannya dan ia mendapat siksa (dari kejahatan) yang dikerjakannya. (Mereka berdoa), “Ya Tuhan kami, janganlah Engkau hukum kami jika kami lupa atau kami melakukan kesalahan. Ya Tuhan kami, janganlah Engkau bebani kami dengan beban yang berat sebagaimana Engkau bebankan kepada orang-orang sebelum kami. Ya Tuhan kami, janganlah Engkau pikulkan kepada kami apa yang tidak sanggup kami memikulnya. Maafkanlah kami, ampunilah kami, dan rahmatilah kami. Engkaulah pelindung kami, maka tolonglah kami menghadapi orang-orang kafir.”',
                'repeat' => 1
            ],
            [
                'title' => 'Al-Ikhlas',
                'arabic' => 'بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ ۝ قُلْ هُوَ اللّٰهُ اَحَدٌۚ ۝ اَللّٰهُ الصَّمَدُۚ ۝ لَمْ يَلِدْ وَلَمْ يُوْلَدْۙ ۝ وَلَمْ يَكُنْ لَّهٗ كُفُوًا اَحَدٌ',
                'latin' => 'Bismillaahir rahmaanir rahiim. Qul huwallaahu ahad. Allaahush shamad. Lam yalid wa lam yuulad. Wa lam yakul lahuu kufuwan ahad.',
                'translation' => 'Dengan nama Allah Yang Maha Pengasih lagi Maha Penyayang. Katakanlah (Muhammad), “Dialah Allah, Yang Maha Esa. Allah tempat meminta segala sesuatu. (Allah) tidak beranak dan tidak pula diperanakkan. Dan tidak ada sesuatu yang setara dengan Dia.”',
                'repeat' => 3
            ],
            [
                'title' => 'Al-Falaq',
                'arabic' => 'بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ ۝ قُلْ اَعُوْذُ بِرَبِّ الْفَلَقِۙ ۝ مِنْ شَرِّ مَا خَلَقَۙ ۝ وَمِنْ شَرِّ غَاسِقٍ اِذَا وَقَبَۙ ۝ وَمِنْ شَرِّ النَّفّٰثٰتِ فِى الْعُقَدِۙ ۝ وَمِنْ شَرِّ حَاسِدٍ اِذَا حَسَدَ',
                'latin' => 'Bismillaahir rahmaanir rahiim. Qul a’uudzu birabbil falaq. Min syarri maa khalaq. Wa min syarri ghaasiqin idzaa waqab. Wa min syarrin naffaatsaati fil ‘uqad. Wa min syarri haasidin idzaa hasad.',
                'translation' => 'Dengan nama Allah Yang Maha Pengasih lagi Maha Penyayang. Katakanlah, “Aku berlindung kepada Tuhan yang menguasai subuh (fajar), dari kejahatan (makhluk yang) Dia ciptakan, dan dari kejahatan malam apabila telah gelap gulita, dan dari kejahatan (perempuan-perempuan) penyihir yang meniup pada buhul-buhul (talinya), dan dari kejahatan orang yang dengki apabila dia dengki.”',
                'repeat' => 3
            ],
            [
                'title' => 'An-Naas',
                'arabic' => 'بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ . قُلْ اَعُوْذُ بِرَبِّ النَّاسِۙ ۝ مَلِكِ النَّاسِۙ ۝ اِلٰهِ النَّاسِۙ ۝ مِنْ شَرِّ الْوَسْوَاسِ ەۙ الْخَنَّاسِۖ ۝ الَّذِيْ يُوَسْوِسُ فِيْ صُدُوْرِ النَّاسِۙ ۝ مِنَ الْجِنَّةِ وَالنَّاسِ',
                'latin' => 'Bismillaahir rahmaanir rahiim. Qul a’uudzu birabbin naas. Maalikin naas. Ilaahin naas. Min syarril waswaasil khannaas. Alladzii yuwaswisu fii shuduurin naas. Minal jinnati wannaas.',
                'translation' => 'Dengan nama Allah Yang Maha Pengasih lagi Maha Penyayang. Katakanlah, “Aku berlindung kepada Tuhannya manusia, Raja manusia, Sembahan manusia, dari kejahatan (bisikan) setan yang bersembunyi, yang membisikkan (kejahatan) ke dalam dada manusia, dari (golongan) jin dan manusia.”',
                'repeat' => 3
            ],
                        [
                'title' => 'Sayyidul Istighfar',
                'arabic' => 'اللَّهُمَّ أَنْتَ رَبِّي لَا إِلَهَ إِلَّا أَنْتَ، خَلَقْتَنِي وَأَنَا عَبْدُكَ، وَأَنَا عَلَى عَهْدِكَ وَوَعْدِكَ مَا اسْتَطَعْتُ، أَعُوذُ بِكَ مِنْ شَرِّ مَا صَنَعْتُ، أَبُوءُ لَكَ بِنِعْمَتِكَ عَلَيَّ، وَأَبُوءُ بِذَنْبِي فَاغْفِرْ لِي فَإِنَّهُ لَا يَغْفِرُ الذُّنُوبَ إِلَّا أَنْتَ',
                'latin' => 'Allahumma anta rabbii laa ilaaha illaa anta, khalaqtanii wa ana ‘abduka, wa ana ‘alaa ‘ahdika wa wa’dika masta-tha’tu. A’uudzu bika min syarri maa shana’tu, abuu-u laka bini’matika ‘alayya, wa abuu-u bidzanbii faghfir lii fa-innahu laa yaghfirudz-dzunuuba illaa anta.',
                'translation' => 'Ya Allah, Engkau adalah Tuhanku, tidak ada Tuhan selain Engkau. Engkau yang menciptakan aku dan aku adalah hamba-Mu. Aku menetapi janji dan ikrar-Mu sebisa mampuku. Aku berlindung kepada-Mu dari keburukan yang aku perbuat. Aku mengakui nikmat-Mu kepadaku dan aku mengakui dosaku, maka ampunilah aku. Sesungguhnya tidak ada yang mengampuni dosa-dosa kecuali Engkau.',
                'repeat' => 1
            ],
        ];

        // ======================
        // DZIKIR PAGI
        // ======================
        $dzikirPagi = [
            [
                'title' => 'Dzikir Pagi – Kepemilikan Allah',
                'arabic' => 'أَصْبَحْنَا وَأَصْبَحَ الْمُلْكُ لِلّٰهِ، وَالْحَمْدُ لِلّٰهِ لَا شَرِيْكَ لَهُ، لَا إِلَهَ إِلَّا هُوَ وَإِلَيْهِ النُّشُوْرُ',
                'latin' => 'Ashbahnaa wa ashbahal mulku lillaahi walhamdu lillaahi laa syariika lah, laa ilaaha illaa huwa wa ilaihin nusyuur.',
                'translation' => 'Kami memasuki waktu pagi dan kerajaan hanya milik Allah. Segala puji bagi Allah, tiada sekutu bagi-Nya, tiada Tuhan selain Dia dan kepada-Nya tempat kembali.',
                'repeat' => 3
            ],
            [
                'title' => 'Dzikir Fitrah Islam',
                'arabic' => 'أَصْبَحْنَا عَلَى فِطْرَةِ الْإِسْلَامِ، وَكَلِمَةِ الْإِخْلَاصِ، وَعَلَى دِيْنِ نَبِيِّنَا مُحَمَّدٍ ﷺ وَعَلَى مِلَّةِ أَبِيْنَا إِبْرَاهِيْمَ حَنِيْفًا وَمَا كَانَ مِنَ الْمُشْرِكِيْنَ',
                'latin' => 'Ashbahnaa ‘ala fithratil Islaam, wa kalimatil ikhlash, wa ‘alaa diini nabiyyinaa Muhammadin shallallahu ‘alaihi wa sallam, wa ‘alaa millati abiinaa Ibraahiima haniifaw wa maa kaana minal musyrikiin.',
                'translation' => 'Kami menyongsong pagi di atas fitrah Islam, kalimat ikhlas (syahadat), agama Nabi kami Muhammad ﷺ, dan di atas agama bapak kami Ibrahim yang hanif (lurus), dan ia bukan termasuk golongan orang musyrik.',
                'repeat' => 3
            ],
            [
                'title' => 'Doa Nikmat & Perlindungan',
                'arabic' => 'اللّٰهُمَّ إِنِّي أَصْبَحْتُ مِنْكَ فِي نِعْمَةٍ وَعَافِيَةٍ وَسِتْرٍ، فَأَتِمَّ عَلَيَّ نِعْمَتَكَ وَعَافِيَتَكَ وَسِتْرَكَ فِي الدِّيْنِ وَالدُّنْيَا وَالْآخِرَةِ',
                'latin' => 'Allahumma innii ashbahtu minka fii ni’matin wa ‘aafiyatin wa sitrin, fa-atimma ‘alayya ni’mataka wa ‘aafiyataka wa sitraka fid-diini wad-dunyaa wal aakhirah.',
                'translation' => 'Ya Allah, sesungguhnya aku memasuki pagi ini dengan kenikmatan, kesehatan, dan perlindungan-Mu. Maka sempurnakanlah untukku kenikmatan, kesehatan, dan perlindungan-Mu itu dalam urusan agama, dunia, dan akhiratku.',
                'repeat' => 3
            ],
            [
                'title' => 'Syukur Nikmat',
                'arabic' => 'اللّٰهُمَّ مَا أَصْبَحَ بِيْ مِنْ نِعْمَةٍ أَوْ بِأَحَدٍ مِنْ خَلْقِكَ فَمِنْكَ وَحْدَكَ لَا شَرِيْكَ لَكَ، فَلَكَ الْحَمْدُ وَلَكَ الشُّكْرُ',
                'latin' => 'Allahumma maa ashbaha bii min ni’matin au bi-ahadin min khalqika fa minka wahdaka laa syariika lak, fa lakal hamdu wa lakasy-syukru.',
                'translation' => 'Ya Allah, nikmat apa pun yang menyertaiku pagi ini atau menyertai salah seorang dari makhluk-Mu, maka hanya dari-Mu semata, tidak ada sekutu bagi-Mu. Bagi-Mu segala puji dan syukur.',
                'repeat' => 3
            ],
            [
                'title' => 'Ridha kepada Allah',
                'arabic' => 'رَضِيْتُ بِاللّٰهِ رَبَّا وَبِالْإِسْلَامِ دِيْنًا وَبِمُحَمَّدٍ نَبِيًّا وَرَسُوْلًا، رَبِّ زِدْنِي عِلْمًا وَارْزُقْنِي فَهْمًا وَاجْعَلْنِي مِنَ الصَّالِحِيْنَ',
                'latin' => 'Radhiitu billaahi rabbaa, wa bil islaami diinaa, wa bi muhammadin nabiyyaw wa rasuulaa. Rabbi zidnii ‘ilman warzuqnii fahmaa waj’alnii minash-shaalihiin.',
                'translation' => 'Aku ridha Allah sebagai Tuhanku, Islam sebagai agamaku, dan Muhammad sebagai Nabi dan Rasul. Ya Allah, tambahkanlah aku ilmu dan berikanlah aku rezeki pemahaman, dan jadikanlah aku termasuk golongan orang-orang shalih.',
                'repeat' => 3
            ],
            [
                'title' => 'Tasbih Agung',
                'arabic' => 'سُبْحَانَ اللّٰهِ وَبِحَمْدِهِ عَدَدَ خَلْقِهِ وَرِضَا نَفْسِهِ وَزِنَةَ عَرْشِهِ وَمِدَادَ كَلِمَاتِهِ',
                'latin' => 'Subhaanallaahi wa bihamdihi ‘adada khalqihi wa ridhaa nafsihi wa zinata ‘arsyihi wa madaada kalimaatih.',
                'translation' => 'Maha Suci Allah dan segala puji bagi-Nya sebanyak jumlah makhluk-Nya, menurut keridhaan diri-Nya, seberat timbangan Arsy-Nya, dan sebanyak tinta kalimat-kalimat-Nya.',
                'repeat' => 3
            ],
            [
                'title' => 'Perlindungan Bismillah',
                'arabic' => 'بِسْمِ اللّٰهِ الَّذِي لَا يَضُرُّ مَعَ اسْمِهِ شَيْءٌ فِي الْأَرْضِ وَلَا فِي السَّمَاءِ وَهُوَ السَّمِيْعُ الْعَلِيْمُ',
                'latin' => 'Bismillaahil-ladzii laa yadhurru ma’asmihii syai-un fil ardhi wa laa fis-samaa-i wa huwas-samii’ul ‘aliim.',
                'translation' => 'Dengan nama Allah, yang bersama nama-Nya tidak ada sesuatu pun di bumi ataupun di langit yang dapat membahayakan. Dan Dia-lah Yang Maha Mendengar lagi Maha Mengetahui.',
                'repeat' => 3
            ],
            [
                'title' => 'Istighfar Panjang',
                'arabic' => 'أَسْتَغْفِرُ اللّٰهَ الْعَظِيْمَ الَّذِي لَا إِلَهَ إِلَّا هُوَ الْحَيُّ الْقَيُّوْمُ وَأَتُوْبُ إِلَيْهِ',
                'latin' => 'Astaghfirullaahal ‘adhiimalladzii laa ilaaha illaa huwal hayyul qayyuumu wa atuubu ilaih.',
                'translation' => 'Aku memohon ampun kepada Allah Yang Maha Agung, tiada Tuhan selain Dia Yang Maha Hidup lagi Maha Berdiri Sendiri, dan aku bertaubat kepada-Nya.',
                'repeat' => 10
            ],
            [
                'title' => 'Shalawat Ibrahimiyah',
                'arabic' => 'اللّٰهُمَّ صَلِّ عَلَى سَيِّدِنَا مُحَمَّدٍ وَعَلَى آلِ سَيِّدِنَا مُحَمَّدٍ كَمَا صَلَّيْتَ عَلَى سَيِّدِنَا إِبْرَاهِيْمَ وَعَلَى آلِ سَيِّدِنَا إِبْرَاهِيْمَ، وَبَارِكْ عَلَى سَيِّدِنَا مُحَمَّدٍ وَعَلَى آلِ سَيِّدِنَا مُحَمَّدٍ كَمَا بَارَكْتَ عَلَى سَيِّدِنَا إِبْرَاهِيْمَ وَعَلَى آلِ سَيِّدِنَا إِبْرَاهِيْمَ فِي الْعَالَمِيْنَ إِنَّكَ حَمِيْدٌ مَجِيْدٌ',
                'latin' => 'Allaahumma shalli ‘alaa sayyidinaa muhammadin wa ‘alaa aali sayyidinaa muhammad, kamaa shallaita ‘alaa sayyidinaa ibraahiima wa ‘alaa aali sayyidinaa ibraahiim, wa baarik ‘alaa sayyidinaa muhammadin wa ‘alaa aali sayyidinaa muhammad, kamaa baarakta ‘alaa sayyidinaa ibraahiima wa ‘alaa aali sayyidinaa ibraahiim, fil ‘aalamiina innaka hamiidum majiid.',
                'translation' => 'Ya Allah, limpahkanlah shalawat kepada Nabi Muhammad dan keluarga Nabi Muhammad, sebagaimana Engkau limpahkan shalawat kepada Nabi Ibrahim dan keluarga Nabi Ibrahim. Berkatilah Nabi Muhammad dan keluarga Nabi Muhammad, sebagaimana Engkau berkati Nabi Ibrahim dan keluarga Nabi Ibrahim di seluruh alam semesta, sesungguhnya Engkau Maha Terpuji lagi Maha Mulia.',
                'repeat' => 10
            ],
        ];

        // ======================
        // DZIKIR PETANG
        // ======================
        $dzikirPetang = [
            [
                'title' => 'Dzikir Petang – Kepemilikan Allah',
                'arabic' => 'أَمْسَيْنَا وَأَمْسَى الْمُلْكُ لِلّٰهِ، وَالْحَمْدُ لِلّٰهِ لَا شَرِيْكَ لَهُ، لَا إِلَهَ إِلَّا هُوَ وَإِلَيْهِ الْمَصِيْرُ',
                'latin' => 'Amsaynaa wa amsal mulku lillaahi walhamdu lillaahi laa syariika lah, laa ilaaha illaa huwa wa ilaihil mashiir.',
                'translation' => 'Kami memasuki waktu petang dan kerajaan hanya milik Allah. Segala puji bagi Allah, tiada sekutu bagi-Nya, tiada Tuhan selain Dia dan kepada-Nya tempat kembali.',
                'repeat' => 3
            ],
            [
                'title' => 'Dzikir Fitrah Islam',
                'arabic' => 'أَمْسَيْنَا عَلَى فِطْرَةِ الْإِسْلَامِ، وَكَلِمَةِ الْإِخْلَاصِ، وَعَلَى دِيْنِ نَبِيِّنَا مُحَمَّدٍ ﷺ وَعَلَى مِلَّةِ أَبِيْنَا إِبْرَاهِيْمَ حَنِيْفًا وَمَا كَانَ مِنَ الْمُشْرِكِيْنَ',
                'latin' => 'Amsaynaa ‘alaa fithratil islaam wa kalimatil ikhlaash, wa ‘alaa diini nabiyyinaa muhammadin shallallahu ‘alaihi wa sallam wa ‘alaa millati abiinaa ibraahiima haniifaw wa maa kaana minal musyrikiin.',
                'translation' => 'Kami menyongsong petang di atas fitrah Islam, kalimat ikhlas, agama Nabi Muhammad ﷺ, dan millah Nabi Ibrahim yang lurus, dan ia bukan termasuk orang musyrik.',
                'repeat' => 3
            ],
            [
                'title' => 'Doa Nikmat & Perlindungan',
                'arabic' => 'اللّٰهُمَّ إِنِّي أَمْسَيْتُ مِنْكَ فِي نِعْمَةٍ وَعَافِيَةٍ وَسِتْرٍ، فَأَتِمَّ عَلَيَّ نِعْمَتَكَ وَعَافِيَتَكَ وَسِتْرَكَ فِي الدِّيْنِ وَالدُّنْيَا وَالْآخِرَةِ',
                'latin' => 'Allahumma innii amsaytu minka fii ni‘matin wa ‘aafiyatin wa sitrin, fa-atimma ‘alayya ni’mataka wa ‘aafiyataka wa sitraka fid-diini wad-dunyaa wal aakhirah.',
                'translation' => 'Ya Allah, sesungguhnya aku memasuki petang ini dengan kenikmatan, kesehatan, dan perlindungan-Mu. Maka sempurnakanlah untukku kenikmatan, kesehatan, dan perlindungan-Mu itu dalam urusan agama, dunia, dan akhiratku.',
                'repeat' => 3
            ],
            [
                'title' => 'Syukur Nikmat',
                'arabic' => 'اللّٰهُمَّ مَا أَمْسَى بِيْ مِنْ نِعْمَةٍ أَوْ بِأَحَدٍ مِنْ خَلْقِكَ فَمِنْكَ وَحْدَكَ لَا شَرِيْكَ لَكَ، فَلَكَ الْحَمْدُ وَلَكَ الشُّكْرُ',
                'latin' => 'Allahumma maa amsaa bii min ni‘matin au bi-ahadin min khalqika fa minka wahdaka laa syariika lak, fa lakal hamdu wa lakasy-syukru.',
                'translation' => 'Ya Allah, nikmat apa pun yang menyertaiku petang ini atau menyertai salah seorang dari makhluk-Mu, maka hanya dari-Mu semata, tidak ada sekutu bagi-Mu. Bagi-Mu segala puji dan syukur.',
                'repeat' => 3
            ],
            [
                'title' => 'Ridha kepada Allah',
                'arabic' => 'رَضِيْتُ بِاللّٰهِ رَبَّا وَبِالْإِسْلَامِ دِيْنًا وَبِمُحَمَّدٍ نَبِيًّا وَرَسُوْلًا',
                'latin' => 'Radhiitu billaahi rabbaa wa bil islaami diinaa wa bi muhammadin nabiyyaw wa rasuulaa.',
                'translation' => 'Aku ridha Allah sebagai Rabbku, Islam sebagai agamaku, dan Muhammad sebagai Nabi dan Rasul.',
                'repeat' => 3
            ],
            [
                'title' => 'Tasbih Agung',
                'arabic' => 'سُبْحَانَ اللّٰهِ وَبِحَمْدِهِ عَدَدَ خَلْقِهِ وَرِضَا نَفْسِهِ وَزِنَةَ عَرْشِهِ وَمِدَادَ كَلِمَاتِهِ',
                'latin' => 'Subhaanallaahi wa bihamdihii ‘adada khalqihii wa ridhaa nafsihii wa zinata ‘arsyihii wa madaada kalimaatih.',
                'translation' => 'Maha Suci Allah dan segala puji bagi-Nya sebanyak bilangan makhluk-Nya, serela diri-Nya, seberat timbangan Arsy-Nya, dan sebanyak tinta kalimat-kalimat-Nya.',
                'repeat' => 3
            ],
            [
                'title' => 'Perlindungan Bismillah',
                'arabic' => 'بِسْمِ اللّٰهِ الَّذِي لَا يَضُرُّ مَعَ اسْمِهِ شَيْءٌ فِي الْأَرْضِ وَلَا فِي السَّمَاءِ وَهُوَ السَّمِيْعُ الْعَلِيْمُ',
                'latin' => 'Bismillaahil ladzii laa yadhurru ma’asmihii syai-un fil ardhi wa laa fis-samaa-i wa huwas-samii’ul ‘aliim.',
                'translation' => 'Dengan nama Allah, yang bersama nama-Nya tidak ada sesuatu pun di bumi ataupun di langit yang dapat membahayakan. Dan Dia-lah Yang Maha Mendengar lagi Maha Mengetahui.',
                'repeat' => 3
            ],
            [
                'title' => 'Doa Terhindar dari Syirik',
                'arabic' => 'اللّٰهُمَّ إِنَّا نَعُوْذُ بِكَ مِنْ أَنْ نُشْرِكَ بِكَ شَيْئًا نَعْلَمُهُ وَنَسْتَغْفِرُكَ لِمَا لَا نَعْلَمُهُ',
                'latin' => 'Allahumma innaa na‘uudzu bika min an nusyrika bika syai-an na‘lamuhu wa nastaghfiruka limaa laa na‘lamuh.',
                'translation' => 'Ya Allah, sesungguhnya kami berlindung kepada-Mu dari mempersekutukan-Mu dengan sesuatu yang kami ketahui, dan kami memohon ampun kepada-Mu atas apa yang tidak kami ketahui.',
                'repeat' => 3
            ],
            [
                'title' => 'Perlindungan dari Segala Keburukan',
                'arabic' => 'أَعُوْذُ بِكَلِمَاتِ اللّٰهِ التَّامَّاتِ مِنْ شَرِّ مَا خَلَقَ',
                'latin' => 'A‘uudzu bikalimaatillaahit taammaati min syarri maa khalaq.',
                'translation' => 'Aku berlindung dengan kalimat-kalimat Allah yang sempurna dari keburukan makhluk ciptaan-Nya.',
                'repeat' => 3
            ],
            [
                'title' => 'Istighfar',
                'arabic' => 'أَسْتَغْفِرُ اللّٰهَ الْعَظِيْمَ الَّذِي لَا إِلَهَ إِلَّا هُوَ الْحَيُّ الْقَيُّوْمُ وَأَتُوْبُ إِلَيْهِ',
                'latin' => 'Astaghfirullaahal ladzii laa ilaaha illaa huwal hayyul qayyuumu wa atuubu ilaih.',
                'translation' => 'Aku memohon ampun kepada Allah Yang Maha Agung, tiada Tuhan selain Dia Yang Maha Hidup lagi Maha Berdiri Sendiri, dan aku bertaubat kepada-Nya.',
                'repeat' => 10
            ],
        ];


        // ======================
        // DZIKIR TAMBAHAN KUBRA
        // ======================
        $penutup = [
            [
                'title' => 'Shalawat Nabi',
                'arabic' => 'اللَّهُمَّ صَلِّ عَلَى سَيِّدِنَا مُحَمَّدٍ وَعَلَى آلِ سَيِّدِنَا مُحَمَّدٍ',
                'latin' => 'Allahumma shalli ‘alaa sayyidinaa Muhammad wa ‘alaa aali sayyidinaa Muhammad.',
                'translation' => 'Ya Allah, limpahkanlah shalawat kepada junjungan kami Nabi Muhammad dan kepada keluarga Nabi Muhammad.',
                'repeat' => 10
            ],
        ];

        // ======================
        // GABUNGKAN DATA
        // ======================
        $data = array_merge(
            $bacaanUmum,
            $isPagi ? $dzikirPagi : $dzikirPetang,
            $penutup
        );

        return view('pages.bacaan.almasurat', compact('data', 'waktu', 'isPagi'));
    }
}
