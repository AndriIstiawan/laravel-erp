<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                [
                    'name' => 'MCB',
                    'slug' => 'mcb',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'ELCB',
                    'slug' => 'elcb',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'SOFT STARTER',
                    'slug' => 'soft-starter',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'ACB',
                    'slug' => 'acb',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'ALTIVAR',
                    'slug' => 'altivar',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'MCCB',
                    'slug' => 'mccb',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'PUSHBUTTON',
                    'slug' => 'pushbutton',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'SWITCHES',
                    'slug' => 'switches',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'SOCKETS DATA',
                    'slug' => 'sockets-data',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'SOCKETS TELEPHONE',
                    'slug' => 'sockets-telephone',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'COVER',
                    'slug' => 'cover',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'SOCKET OUTLETS',
                    'slug' => 'socket-outlets',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'CONDUIT',
                    'slug' => 'conduit',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'BALLAST',
                    'slug' => 'ballast',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'BOHLAM',
                    'slug' => 'bohlam',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'CFLI',
                    'slug' => 'cfli',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'CONFENTIONAL',
                    'slug' => 'confentional',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'CONSLUM',
                    'slug' => 'conslum',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'GARDEN LIGHT',
                    'slug' => 'garden-light',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'HIGHT BAY',
                    'slug' => 'hight-bay',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'HOME',
                    'slug' => 'home',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'LED',
                    'slug' => 'led',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'PROFESSIONAL',
                    'slug' => 'professional',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'SAKLAR',
                    'slug' => 'saklar',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'STREET LIGHT',
                    'slug' => 'street-light',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'DOMAE',
                    'slug' => 'domae',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'NG125L',
                    'slug' => 'ng125l',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'ACTI9',
                    'slug' => 'act19',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'RX3 4500',
                    'slug' => 'rx3-4500',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'RX3 6000',
                    'slug' => 'rx3-6000',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'ATS22',
                    'slug' => 'ats22',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'MVS',
                    'slug' => 'mvs',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'NW',
                    'slug' => 'nw',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'ATV310',
                    'slug' => 'atv310',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'ATV630',
                    'slug' => 'atv630',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'NS',
                    'slug' => 'ns',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'NSX',
                    'slug' => 'nsx',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'CVS',
                    'slug' => 'cvs',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'XB4',
                    'slug' => 'xb4',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'XB5',
                    'slug' => 'xb5',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'MALLIA',
                    'slug' => 'mallia',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'ARTEOR',
                    'slug' => 'arteor',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'BELANKO',
                    'slug' => 'belanko',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'NILOE',
                    'slug' => 'niloe',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => '25MM',
                    'slug' => '25mm',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => '20MM',
                    'slug' => '20mm',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'BMH',
                    'slug' => 'bmh',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'CLAS',
                    'slug' => 'clas',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'CAPSULE',
                    'slug' => 'capsule',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'DOWNLIGHT',
                    'slug' => 'downlight',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'WALL LAMP',
                    'slug' => 'wall-lamp',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'BVP',
                    'slug' => 'bvp',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'BY',
                    'slug' => 'by',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'PENDANT LAMP',
                    'slug' => 'pendant-lamp',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'BULB',
                    'slug' => 'bulb',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'CLASSIC',
                    'slug' => 'classic',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'BN',
                    'slug' => 'bn',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'AGILESTYLE',
                    'slug' => 'agilestyle',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'BRP',
                    'slug' => 'brp',
                    'parent' => [],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ],
            ]
        );

        $parent = DB::table('categories')->whereIn('slug',['mcb','elcb'])->get();
        DB::table('categories')->whereIn('slug', ['domae','act19'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['mcb'])->get();
        DB::table('categories')->whereIn('slug', ['ng125l'])->update(['parent' => $parent->toArray()]);
        DB::table('categories')->whereIn('slug', ['rx3-4500'])->update(['parent' => $parent->toArray()]);
        DB::table('categories')->whereIn('slug', ['rx3-6000'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['soft-starter'])->get();
        DB::table('categories')->whereIn('slug', ['ats22'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['acb'])->get();
        DB::table('categories')->whereIn('slug', ['mvs','nw'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['altivar'])->get();
        DB::table('categories')->whereIn('slug', ['atv310','atv630'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['mccb'])->get();
        DB::table('categories')->whereIn('slug', ['ns','nsx','cvs'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['pushbutton'])->get();
        DB::table('categories')->whereIn('slug', ['xb4','xb5'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['pushbutton'])->get();
        DB::table('categories')->whereIn('slug', ['xb4','xb5'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['switches','sockets-data','sockets-telephone'])->get();
        DB::table('categories')->whereIn('slug', ['mallia'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['switches','cover'])->get();
        DB::table('categories')->whereIn('slug', ['arteor'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['switches','sockets-data','socket-outlets'])->get();
        DB::table('categories')->whereIn('slug', ['belanko'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['cover'])->get();
        DB::table('categories')->whereIn('slug', ['niloe'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['conduit'])->get();
        DB::table('categories')->whereIn('slug', ['25mm','20mm'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['ballast'])->get();
        DB::table('categories')->whereIn('slug', ['bmh'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['bohlam'])->get();
        DB::table('categories')->whereIn('slug', ['clas'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['cfli'])->get();
        DB::table('categories')->whereIn('slug', ['capsule'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['confentional','led'])->get();
        DB::table('categories')->whereIn('slug', ['downlight'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['conslum'])->get();
        DB::table('categories')->whereIn('slug', ['wall-lamp'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['garden-light'])->get();
        DB::table('categories')->whereIn('slug', ['bvp'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['hight-bay'])->get();
        DB::table('categories')->whereIn('slug', ['by'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['home'])->get();
        DB::table('categories')->whereIn('slug', ['pendant-lamp'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['led'])->get();
        DB::table('categories')->whereIn('slug', ['bulb', 'classic'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['professional'])->get();
        DB::table('categories')->whereIn('slug', ['bn'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['saklar'])->get();
        DB::table('categories')->whereIn('slug', ['agilestyle'])->update(['parent' => $parent->toArray()]);
        $parent = DB::table('categories')->whereIn('slug',['street-light'])->get();
        DB::table('categories')->whereIn('slug', ['brp'])->update(['parent' => $parent->toArray()]);
    }
}
