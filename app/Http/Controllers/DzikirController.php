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
        // 1. AYAT AL-QUR'AN (KUBRA)
        // ======================
        $bacaanUmum = [
            [
                'title' => 'Ta’awudz & Basmalah',
                'arabic' => 'أَعُوذُ بِاللّٰهِ مِنَ الشَّيْطَانِ الرَّجِيمِ بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ',
                'latin' => 'A‘uudzu billaahi minasy syaithaanir rajiim. Bismillaahir rahmaanir rahiim.',
                'translation' => 'Aku berlindung kepada Allah dari godaan setan yang terkutuk. Dengan nama Allah Yang Maha Pengasih lagi Maha Penyayang.',
                'repeat' => 1
            ],
            [
                'title' => 'Al-Fatihah',
                'arabic' => 'بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ ۝ اَلْحَمْدُ لِلّٰهِ رَبِّ الْعٰلَمِيْنَۙ ۝ الرَّحْمٰنِ الرَّحِيْمِۙ ۝ مٰلِكِ يَوْمِ الدِّيْنِۗ ۝ اِيَّاكَ نَعْبُدُ وَاِيَّاكَ نَسْتَعِيْنُۗ ۝ اِهْدِنَا الصِّرَاطَ الْمُسْتَقِيْمَۙ ۝ صِرَاطَ الَّذِيْنَ اَنْعَمْتَ عَلَيْهِمْ ەۙ غَيْرِ الْمَغْضُوْبِ عَلَيْهِمْ وَلَا الضَّآلِّيْنَ ۝',
                'latin' => 'Bismillaahir rahmaanir rahiim. Alhamdulillaahi rabbil ‘aalamiin. Ar-rahmaanir rahiim. Maaliki yaumid diin. Iyyaaka na’budu wa iyyaaka nasta’iin. Ihdinash shiraathal mustaqiim. Shiraathalladziina an’amta ‘alaihim ghairil maghdhuubi ‘alaihim waladh-dhaalliin.',
                'translation' => 'Dengan nama Allah Yang Maha Pengasih lagi Maha Penyayang. Segala puji bagi Allah, Tuhan semesta alam...',
                'repeat' => 1
            ],
            [
                'title' => 'Al-Baqarah 1–5',
                'arabic' => 'بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ ۝ الۤمّۤ ۚ ۝ ذٰلِكَ الْكِتٰبُ لَا رَيْبَ ۛ فِيْهِ ۛ هُدًى لِّلْمُتَّقِيْنَۙ ۝ الَّذِيْنَ يُؤْمِنُوْنَ بِالْغَيْبِ وَيُقِيْمُوْنَ الصَّلٰوةَ وَمِمَّا رَزَقْنٰهُمْ يُنْفِقُوْنَ ۙ ۝ وَالَّذِيْنَ يُؤْمِنُوْنَ بِمَآ اُنْزِلَ اِلَيْكَ وَمَآ اُنْزِلَ مِنْ قَبْلِكَ ۚ وَبِالْاٰخِرَةِ هُمْ يُوْقِنُوْنَۗ۝ اُولٰۤىِٕكَ عَلٰى هُدًى مِّنْ رَّبِّهِمْ ۙ وَاُولٰۤىِٕكَ هُمُ الْمُفْلِحُوْنَ ۝',
                'latin' => 'Alif-laam-miim. Dzaalikal kitaabu laa raiba fiihi hudal lil muttaqiin. Alladziina yu’minuuna bil ghaibi wa yuqiimuunash shalaata wa mimmaa razaqnaahum yunfiquun...',
                'translation' => 'Alif Lam Mim. Kitab (Al-Qur’an) ini tidak ada keraguan padanya; petunjuk bagi mereka yang bertakwa...',
                'repeat' => 1
            ],
            [
                'title' => 'Ayat Kursi & Al-Baqarah 256-257',
                'arabic' => 'اَللّٰهُ لَآ اِلٰهَ اِلَّا هُوَۚ اَلْحَيُّ الْقَيُّوْمُ ەۚ لَا تَأْخُذُهٗ سِنَةٌ وَّلَا نَوْمٌۗ لَهٗ مَا فِى السَّمٰوٰتِ وَمَا فِى الْاَرْضِۗ مَنْ ذَا الَّذِيْ يَشْفَعُ عِنْدَهٗٓ اِلَّا بِاِذْنِهٖۗ يَعْلَمُ مَا بَيْنَ اَيْدِيْهِمْ وَمَا خَلْفَهُمْۚ وَلَا يُحِيْطُوْنَ بِشَيْءٍ مِّنْ عِلْمِهٖٓ اِلَّا بِمَا شَاۤءَۚ وَسِعَ كُرْسِيُّهُ السَّمٰوٰتِ وَالْاَرْضَۚ وَلَا يَـُٔوْدُهٗ حِفْظُهُمَاۚ وَهُوَ الْعَلِيُّ الْعَظِيْمُ ۝ لَآ اِكْرَاهَ فِى الدِّيْنِۗ قَدْ تَّبَيَّنَ الرُّشْدُ مِنَ الْغَيِّ ۚ فَمَنْ يَّكْفُرْ بِالطَّاغُوْتِ وَيُؤْمِنْۢ بِاللّٰهِ فَقَدِ اسْتَمْسَكَ بِالْعُرْوَةِ الْوُثْقٰى لَا انْفِصَامَ لَهَا ۗوَاللّٰهُ سَمِيْعٌ عَلِيْمٌ ۝ اَللّٰهُ وَلِيُّ الَّذِيْنَ اٰمَنُوْا يُخْرِجُهُمْ مِّنَ الظُّلُمٰتِ اِلَى النُّوْرِۗ وَالَّذِيْنَ كَفَرُوْٓا اَوْلِيَاۤؤُهُمُ الطَّاغُوْتُ يُخْرِجُوْنَهُمْ مِّنَ النُّوْرِ اِلَى الظُّلُمٰتِۗ اُولٰۤىِٕكَ اَصْحٰبُ النَّارِۚ هُمْ فِيْهَا خٰلِدُوْنَ',
                'latin' => 'Allaahu laa ilaaha illaa huwal hayyul qayyuum. Laa ta\'khudzuhuu sinatuw wa laa naum. Lahuu maa fis samaawaati wa maa fil ardh. Man dzal ladzii yasyfa\'u \'indahuu illaa bi-idznih...',
                'translation' => 'Allah, tidak ada Tuhan selain Dia. Yang Maha Hidup, Yang terus menerus mengurus (makhluk-Nya), tidak mengantuk dan tidak tidur. Milik-Nya apa yang ada di langit dan apa yang ada di bumi...',
                'repeat' => 1
            ],
            [
                'title' => 'Al-Baqarah 284–286',
                'arabic' => 'لِلّٰهِ مَا فِى السَّمٰوٰتِ وَمَا فِى الْاَرْضِ ۗ وَاِنْ تُبْدُوْا مَا فِيْٓ اَنْفُسِكُمْ اَوْ تُخْفُوْهُ يُحَاسِبْكُمْ بِهِ اللّٰهُ ۗ فَيَغْفِرُ لِمَنْ يَّشَاۤءُ وَيُعَذِّبُ مَنْ يَّشَاۤءُ ۗ وَاللّٰهُ عَلٰى كُلِّ شَيْءٍ قَدِيْرٌ ۝ اٰمَنَ الرَّسُوْلُ بِمَآ اُنْزِلَ اِلَيْهِ مِنْ رَّبِّهٖ وَالْمُؤْمِنُوْنَۗ كُلٌّ اٰمَنَ بِاللّٰهِ وَمَلٰۤىِٕكَتِهٖ وَكُتُبِهٖ وَرُسُلِهٖۗ لَا نُفَرِّقُ بَيْنَ اَحَدٍ مِّنْ رُّسُلِهٖ ۗ وَقَالُوْا سَمِعْنَا وَاَطَعْنَا غُفْرَانَكَ رَبَّنَا وَاِلَيْكَ الْمَصِيْرُ ۝ لَا يُكَلِّفُ اللّٰهُ نَفْسًا اِلَّا وُسْعَهَا ۗ لَهَا مَا كَسَبَتْ وَعَلَيْهَا مَا اكْتَسَبَتْ ۗ رَبَّنَا لَا تُؤَاخِذْنَآ اِنْ نَّسِيْنَآ اَوْ اَخْطَأْنَا ۚ رَبَّنَا وَلَا تَحْمِلْ عَلَيْنَآ اِصْرًا كَمَا حَمَلْتَهٗ عَلَى الَّذِيْنَ مِنْ قَبْلِنَا ۚ رَبَّنَا وَلَا تُحَمِّلْنَا مَا لَا طَاقَةَ لَنَا بِهٖۚ وَاعْفُ عَنَّاۗ وَاغْفِرْ لَنَاۗ وَارْحَمْنَا ۗ اَنْتَ مَوْلٰىنَا فَانْصُرْنَا عَلَى الْقَوْمِ الْكٰفِرِيْنَ ۝',
                'latin' => 'Lillaahi maa fis samaawaati wa maa fil ardh. Wa in tubduu maa fii anfusikum au tukhfuuhu yuhaasibkum bihillah...',
                'translation' => 'Milik Allah-lah apa yang ada di langit dan apa yang ada di bumi. Jika kamu nyatakan apa yang ada di dalam hatimu atau kamu sembunyikan, niscaya Allah memperhitungkannya bagimu...',
                'repeat' => 1
            ],
            [
                'title' => 'Al-Hasyr 22-24 (Khas Kubra)',
                'arabic' => 'هُوَ اللّٰهُ الَّذِيْ لَآ اِلٰهَ اِلَّا هُوَۚ عَالِمُ الْغَيْبِ وَالشَّهَادَةِۚ هُوَ الرَّحْمٰنُ الرَّحِيْمُ ۝ هُوَ اللّٰهُ الَّذِيْ لَآ اِلٰهَ اِلَّا هُوَ ۚ اَلْمَلِكُ الْقُدُّوْسُ السَّلٰمُ الْمُؤْمِنُ الْمُهَيْمِنُ الْعَزِيْزُ الْجَبَّارُ الْمُتَكَبِّرُۗ سُبْحٰنَ اللّٰهِ عَمَّا يُشْرِكُوْنَ ۝ هُوَ اللّٰهُ الْخَالِقُ الْبَارِئُ الْمُصَوِّرُ لَهُ الْاَسْمَآءُ الْحُسْنٰىۗ يُسَبِّحُ لَهٗ مَا فِى السَّمٰوٰتِ وَالْاَرْضِۚ وَهُوَ الْعَزِيْزُ الْحَكِيْمُ',
                'latin' => 'Huwallaa-hulladzii laa ilaaha illaa huw. ‘Aalimul ghaibi wasy-syahaadah. Huwar rahmaanur rahiim. Huwallaa-hulladzii laa ilaaha illaa huw. Almalikul qudduusus-salaamul mu’minul muhaiminul ‘aziizul jabbaarul mutakabbir. Subhaanallaahi ‘ammaa yusyrikuun. Huwallaahul khaaliqul baari-ul mushawwiru lahul asmaa-ul husnaa. Yusabbihu lahuu maa fis-samaawaati wal-ardh. Wahuwal ‘aziizul hakiim.',
                'translation' => 'Dialah Allah tidak ada Tuhan selain Dia. Yang Mengetahui yang gaib dan yang nyata, Dialah Yang Maha Pengasih, Maha Penyayang. Dialah Allah tidak ada Tuhan selain Dia. Maharaja, Yang Maha Suci, Yang Maha Sejahtera, Yang Menjaga Keamanan, Pemelihara Keselamatan, Yang Maha Perkasa, Yang Maha Kuasa, Yang Memiliki Segala Keagungan. Maha Suci Allah dari apa yang mereka persekutukan. Dialah Allah Yang Menciptakan, Yang Mengadakan, Yang Membentuk Rupa, Dia memiliki nama-nama yang indah. Apa yang di langit dan di bumi bertasbih kepada-Nya. Dan Dialah Yang Maha Perkasa, Maha Bijaksana.',
                'repeat' => 1
            ],
            [
                'title' => 'At-Taubah 129',
                'arabic' => 'حَسْبِيَ اللّٰهُ لَآ اِلٰهَ اِلَّا هُوَ ۗ عَلَيْهِ تَوَكَّلْتُ وَهُوَ رَبُّ الْعَرْشِ الْعَظِيْمِ',
                'latin' => 'Hasbiyallaahu laa ilaaha illaa huw. ‘Alaihi tawakkaltu wa huwa rabbul ‘arsyil ‘azhiim.',
                'translation' => 'Cukuplah Allah bagiku; tidak ada Tuhan selain Dia. Hanya kepada-Nya aku bertawakal dan Dia adalah Tuhan yang memiliki ‘Arsy yang agung.',
                'repeat' => 7
            ],
            [
                'title' => 'Al-Kafirun',
                'arabic' => 'بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ ۝ قُلْ يٰٓاَيُّهَا الْكٰفِرُوْنَۙ ۝ لَآ اَعْبُدُ مَا تَعْبُدُوْنَۙ ۝ وَلَآ اَنْتُمْ عٰبِدُوْنَ مَآ اَعْبُدُۚ ۝ وَلَآ اَنَا۠ عَابِدٌ مَّا عَبَدْتُّمْۙ ۝ وَلَآ اَنْتُمْ عٰبِدُوْنَ مَآ اَعْبُدُۗ ۝ لَكُمْ دِيْنُكُمْ وَلِيَ دِيْنِ ۝',
                'latin' => 'Bismillaahir rahmaanir rahiim. Qul yaa ayyuhal kaafiruun. Laa a’budu maa ta’buduun. Wa laa antum ‘aabiduuna maa a’bud. Walaa anaa ‘aabidum maa ‘abattum. Walaa antum ‘aabiduuna maa a’bud. Lakum diinukum wa liya diin.',
                'translation' => 'Katakanlah (Muhammad), "Wahai orang-orang kafir! Aku tidak akan menyembah apa yang kamu sembah, dan kamu bukan penyembah apa yang aku sembah, dan aku tidak pernah menjadi penyembah apa yang kamu sembah, dan kamu tidak pernah (pula) menjadi penyembah apa yang aku sembah. Untukmu agamamu, dan untukku agamaku."',
                'repeat' => 1
            ],
            [
                'title' => 'Al-Ikhlas',
                'arabic' => 'بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ ۝ قُلْ هُوَ اللّٰهُ اَحَدٌۚ ۝ اَللّٰهُ الصَّمَدُۚ ۝ لَمْ يَلِدْ وَلَمْ يُوْلَدْۙ ۝ وَلَمْ يَكُنْ لَّهٗ كُفُوًا اَحَدٌ',
                'latin' => 'Bismillaahir rahmaanir rahiim. Qul huwallaahu ahad. Allaahush shamad. Lam yalid wa lam yuulad. Wa lam yakul lahuu kufuwan ahad.',
                'translation' => 'Katakanlah (Muhammad), “Dialah Allah, Yang Maha Esa...”',
                'repeat' => 3
            ],
            [
                'title' => 'Al-Falaq',
                'arabic' => 'بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ ۝ قُلْ اَعُوْذُ بِرَبِّ الْفَلَقِۙ ۝ مِنْ شَرِّ مَا خَلَقَۙ ۝ وَمِنْ شَرِّ غَاسِقٍ اِذَا وَقَبَۙ ۝ وَمِنْ شَرِّ النَّفّٰثٰتِ فِى الْعُقَدِۙ ۝ وَمِنْ شَرِّ حَاسِدٍ اِذَا حَسَدَ',
                'latin' => 'Bismillaahir rahmaanir rahiim. Qul a’uudzu birabbil falaq. Min syarri maa khalaq. Wa min syarri ghaasiqin idzaa waqab. Wa min syarrin naffaatsaati fil ‘uqad. Wa min syarri haasidin idzaa hasad.',
                'translation' => 'Katakanlah, “Aku berlindung kepada Tuhan yang menguasai subuh...”',
                'repeat' => 3
            ],
            [
                'title' => 'An-Naas',
                'arabic' => 'بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ ۝ قُلْ اَعُوْذُ بِرَبِّ النَّاسِۙ ۝ مَلِكِ النَّاسِۙ ۝ اِلٰهِ النَّاسِۙ ۝ مِنْ شَرِّ الْوَسْوَاسِ ەۙ الْخَنَّاسِۖ ۝ الَّذِيْ يُوَسْوِسُ فِيْ صُدُوْرِ النَّاسِۙ ۝ مِنَ الْجِنَّةِ وَالنَّاسِ',
                'latin' => 'Bismillaahir rahmaanir rahiim. Qul a’uudzu birabbin naas. Maalikin naas. Ilaahin naas. Min syarril waswaasil khannaas. Alladzii yuwaswisu fii shuduurin naas. Minal jinnati wannaas.',
                'translation' => 'Katakanlah, “Aku berlindung kepada Tuhannya manusia...”',
                'repeat' => 3
            ],
        ];

        // ======================
        // 2. DZIKIR PAGI & PETANG
        // ======================
        $dzikirWaktu = [
            [
                'title' => 'Kepemilikan Allah',
                'arabic' => $isPagi ? 'أَصْبَحْنَا وَأَصْبَحَ الْمُلْكُ لِلّٰهِ، وَالْحَمْدُ لِلّٰهِ لَا شَرِيْكَ لَهُ، لَا إِلَهَ إِلَّا هُوَ وَإِلَيْهِ النُّشُوْرُ' : 'أَمْسَيْنَا وَأَمْسَى الْمُلْكُ لِلّٰهِ، وَالْحَمْدُ لِلّٰهِ لَا شَرِيْكَ لَهُ، لَا إِلَهَ إِلَّا هُوَ وَإِلَيْهِ الْمَصِيْرُ',
                'latin' => $isPagi ? 'Ashbahnaa wa ashbahal mulku lillaahi walhamdu lillaahi laa syariika lah, laa ilaaha illaa huwa wa ilaihin nusyuur.' : 'Amsaynaa wa amsal mulku lillaahi walhamdu lillaahi laa syariika lah, laa ilaaha illaa huwa wa ilaihil mashiir.',
                'translation' => $isPagi ? 'Kami memasuki waktu pagi dan kerajaan hanya milik Allah...' : 'Kami memasuki waktu petang dan kerajaan hanya milik Allah...',
                'repeat' => 3
            ],
            [
                'title' => 'Dzikir Fitrah Islam',
                'arabic' => $isPagi ? 'أَصْبَحْنَا عَلَى فِطْرَةِ الْإِسْلَامِ، وَكَلِمَةِ الْإِخْلَاصِ، وَعَلَى دِيْنِ نَبِيِّنَا مُحَمَّدٍ ﷺ وَعَلَى مِلَّةِ أَبِيْنَا إِبْرَاهِيْمَ حَنِيْفًا وَمَا كَانَ مِنَ الْمُشْرِكِيْنَ' : 'أَمْسَيْنَا عَلَى فِطْرَةِ الْإِسْلَامِ، وَكَلِمَةِ الْإِخْلَاصِ، وَعَلَى دِيْنِ نَبِيِّنَا مُحَمَّدٍ ﷺ وَعَلَى مِلَّةِ أَبِيْنَا إِبْرَاهِيْمَ حَنِيْفًا وَمَا كَانَ مِنَ الْمُشْرِكِيْنَ',
                'latin' => $isPagi ? 'Ashbahnaa ‘ala fithratil Islaam...' : 'Amsaynaa ‘alaa fithratil islaam...',
                'translation' => $isPagi ? 'Kami menyongsong pagi di atas fitrah Islam...' : 'Kami menyongsong petang di atas fitrah Islam...',
                'repeat' => 3
            ],
            [
                'title' => 'Doa Nikmat & Perlindungan',
                'arabic' => $isPagi ? 'اللّٰهُمَّ إِنِّي أَصْبَحْتُ مِنْكَ فِي نِعْمَةٍ وَعَافِيَةٍ وَسِتْرٍ، فَأَتِمَّ عَلَيَّ نِعْمَتَكَ وَعَافِيَتَكَ وَسِتْرَكَ فِي الدِّيْنِ وَالدُّنْيَا وَالْآخِرَةِ' : 'اللّٰهُمَّ إِنِّي أَمْسَيْتُ مِنْكَ فِي نِعْمَةٍ وَعَافِيَةٍ وَسِتْرٍ، فَأَتِمَّ عَلَيَّ نِعْمَتَكَ وَعَافِيَتَكَ وَسِتْرَكَ فِي الدِّيْنِ وَالدُّنْيَا وَالْآخِرَةِ',
                'latin' => $isPagi ? 'Allahumma innii ashbahtu minka fii ni’matin...' : 'Allahumma innii amsaytu minka fii ni‘matin...',
                'translation' => $isPagi ? 'Ya Allah, sesungguhnya aku memasuki pagi ini dengan kenikmatan...' : 'Ya Allah, sesungguhnya aku memasuki petang ini dengan kenikmatan...',
                'repeat' => 3
            ],
            [
                'title' => 'Syukur Nikmat',
                'arabic' => $isPagi ? 'اللّٰهُمَّ مَا أَصْبَحَ بِيْ مِنْ نِعْمَةٍ أَوْ بِأَحَدٍ مِنْ خَلْقِكَ فَمِنْكَ وَحْدَكَ لَا شَرِيْكَ لَكَ، فَلَكَ الْحَمْدُ وَلَكَ الشُّكْرُ' : 'اللّٰهُمَّ مَا أَمْسَى بِيْ مِنْ نِعْمَةٍ أَوْ بِأَحَدٍ مِنْ خَلْقِكَ فَمِنْكَ وَحْدَكَ لَا شَرِيْكَ لَكَ، فَلَكَ الْحَمْدُ وَلَكَ الشُّكْرُ',
                'latin' => $isPagi ? 'Allahumma maa ashbaha bii min ni’matin...' : 'Allahumma maa amsaa bii min ni‘matin...',
                'translation' => $isPagi ? 'Ya Allah, nikmat apa pun yang menyertaiku pagi ini...' : 'Ya Allah, nikmat apa pun yang menyertaiku petang ini...',
                'repeat' => 3
            ],
            [
                'title' => 'Ridha kepada Allah',
                'arabic' => 'رَضِيْتُ بِاللّٰهِ رَبَّا وَبِالْإِسْلَامِ دِيْنًا وَبِمُحَمَّدٍ نَبِيًّا وَرَسُوْلًا',
                'latin' => 'Radhiitu billaahi rabbaa wa bil islaami diinaa wa bi muhammadin nabiyyaw wa rasuulaa.',
                'translation' => 'Aku ridha Allah sebagai Tuhanku, Islam sebagai agamaku, dan Muhammad sebagai Nabi dan Rasul.',
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
        ];

        // ======================
        // 3. PENUTUP & RABITHAH
        // ======================
        $penutup = [
            [
                'title' => 'Sayyidul Istighfar',
                'arabic' => 'اللَّهُمَّ أَنْتَ رَبِّي لَا إِلَهَ إِلَّا أَنْتَ، خَلَقْتَنِي وَأَنَا عَبْدُكَ، وَأَنَا عَلَى عَهْدِكَ وَوَعْدِكَ مَا اسْتَطَعْتُ، أَعُوذُ بِكَ مِنْ شَرِّ مَا صَنَعْتُ، أَبُوءُ لَكَ بِنِعْمَتِكَ عَلَيَّ، وَأَبُوءُ بِذَنْبِي فَاغْفِرْ لِي فَإِنَّهُ لَا يَغْفِرُ الذُّنُوبَ إِلَّا أَنْتَ',
                'latin' => 'Allahumma anta rabbii laa ilaaha illaa anta, khalaqtanii wa ana ‘abduka, wa ana ‘alaa ‘ahdika wa wa’dika masta-tha’tu. A’uudzu bika min syarri maa shana’tu, abuu-u laka bini’matika ‘alayya, wa abuu-u bidzanbii faghfir lii fa-innahu laa yaghfirudz-dzunuuba illaa anta.',
                'translation' => 'Ya Allah, Engkau adalah Tuhanku, tidak ada Tuhan selain Engkau. Engkau yang menciptakan aku dan aku adalah hamba-Mu. Aku menetapi janji dan ikrar-Mu sebisa mampuku...',
                'repeat' => 1
            ],
            [
                'title' => 'Istighfar',
                'arabic' => 'أَسْتَغْفِرُ اللّٰهَ الْعَظِيْمَ الَّذِي لَا إِلَهَ إِلَّا هُوَ الْحَيُّ الْقَيُّوْمُ وَأَتُوْبُ إِلَيْهِ',
                'latin' => 'Astaghfirullaahal ‘adhiimalladzii laa ilaaha illaa huwal hayyul qayyuumu wa atuubu ilaih.',
                'translation' => 'Aku memohon ampun kepada Allah Yang Maha Agung, tiada Tuhan selain Dia Yang Maha Hidup lagi Maha Berdiri Sendiri, dan aku bertaubat kepada-Nya.',
                'repeat' => 3
            ],
            [
                'title' => 'Shalawat Nabi',
                'arabic' => 'اللَّهُمَّ صَلِّ عَلَى سَيِّدِنَا مُحَمَّدٍ وَعَلَى آلِ سَيِّدِنَا مُحَمَّدٍ',
                'latin' => 'Allahumma shalli ‘alaa sayyidinaa Muhammad wa ‘alaa aali sayyidinaa Muhammad.',
                'translation' => 'Ya Allah, limpahkanlah shalawat kepada junjungan kami Nabi Muhammad dan kepada keluarga Nabi Muhammad.',
                'repeat' => 10
            ],
            [
                'title' => 'Doa Rabithah',
                'arabic' => 'اَللّٰهُمَّ اِنَّكَ تَعْلَمُ اَنَّ هٰذِهِ الْقُلُوْبَ قَدِ اجْتَمَعَتْ عَلَى مَحَبَّتِكَ، وَالْتَقَتْ عَلَى طَاعَتِكَ، وَتَوَحَّدَتْ عَلَى دَعْوَتِكَ، وَتَعَاهَدَتْ عَلَى نُصْرَةِ شَرِيْعَتِكَ، فَوَثِّقِ اللّٰهُمَّ رَابِطَتَهَا، وَاَدِمْ وُدَّهَا， وَاهْدِهَا سُبُلَهَا， وَامْلَأْهَا بِنُوْرِكَ الَّذِيْ لَا يَخْبُوْا， وَاشْرَحْ صُدُوْرَهَا بِفَيْضِ الْاِيْمَانِ بِكَ， وَجَمِيْلِ التَّوَكُّلِ عَلَيْكَ， وَاَحْيِهَا بِمَعْرِفَتِكَ， وَاَمِتْهَا عَلَى الشَّهَادَةِ فِيْ سَبِيْلِكَ، اِنَّكَ نِعْمَ الْمَوْلٰى وَنِعْمَ النَّصِيْرِ. اَللّٰهُمَّ اٰمِيْنَ. وَصَلِّ اللّٰهُمּ عַלּى سַيִّدִنَا مُحֲمַدٍ וַعֲלֵי آلِ سַيִّدִنَا مُحֲמַدٍ.',
                'latin' => 'Allahumma innaka ta\'lamu anna haadzihil quluuba qadijtama\'at ‘alaa mahabbatik, waltaqat ‘alaa thaa\'atik, watawahhadat ‘alaa da\'watik, wata\'aahadat ‘alaa nushrati syarii\'atik. Fawats-tsiqillaahumma raabithatahaa, wa adim wuddahaa, wahdihaa subulahaa, wamla\'haa binuurikalladzii laa yakhbuu, wasyrah shuduurahaa bifaidhil iimaani bik, wajamiilit tawakkuli ‘alaik, wa ahyihaa bima\'rifatik, wa amithaa ‘alasy-syahaadati fii sabiilik. Innaka ni\'mal maulaa wani\'man nashiir. Allahumma aamiin. Wa shallillaahumma ‘alaa sayyidinaa Muhammadin wa ‘alaa aalihii washahbihii wasallim.',
                'translation' => 'Ya Allah, sesungguhnya Engkau Maha Mengetahui bahwa hati-hati ini telah berkumpul karena cinta kepada-Mu, bertemu karena taat kepada-Mu, bersatu karena dakwah-Mu, dan berjanji setia untuk membela syariat-Mu. Maka kuatkanlah ya Allah ikatan persaudaraannya, kekalkanlah kasih sayangnya, tunjukkanlah jalannya, penuhilah dengan cahaya-Mu yang tidak pernah padam, lapangkanlah dadanya dengan limpahan iman kepada-Mu dan tawakal yang baik kepada-Mu, hidupkanlah ia dengan ma\'rifat kepada-Mu, dan matikanlah ia sebagai syahid di jalan-Mu. Sesungguhnya Engkau sebaik-baik pelindung dan penolong. Ya Allah, kabulkanlah. Dan limpahkanlah shalawat serta salam kepada junjungan kami Nabi Muhammad, keluarga, dan para sahabatnya.',
                'repeat' => 1
            ],
        ];

        // ======================
        // GABUNGKAN DATA
        // ======================
        $data = array_merge($bacaanUmum, $dzikirWaktu, $penutup);

        return view('pages.bacaan.almasurat', compact('data', 'waktu', 'isPagi'));
    }
}