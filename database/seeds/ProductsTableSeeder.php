<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
            [
                [
                    'name' => 'DOMAE MCB',
                    'description' => 'DOMAE MCB',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 600,
                    'sku' => 'ST.DOM',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => 'DOMAE MCB 1.jpg',
                            'size' => 14632,
                        ],
                        [
                            'filename' => 'DOMAE MCB 2.jpg',
                            'size' => 14632,
                        ],
                        [
                            'filename' => 'DOMAE MCB 3.jpg',
                            'size' => 19229,
                        ],
                        [
                            'filename' => 'DOMAE MCB 4.jpg',
                            'size' => 19229,
                        ],
                        [
                            'filename' => 'DOMAE MCB 5.jpg',
                            'size' => 10554,
                        ],
                        [
                            'filename' => 'DOMAE MCB 6.jpg',
                            'size' => 10554,
                        ],
                    ],
                    'price' => [
                        [
                            'min' => 74800,
                            'max' => 286000,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'DOMAE MCB 2P 2A C 230V 4500A',
                            'image' => 'DOMAE MCB 2P 2A C 230V 4500A.jpg',
                            'price' => 209550,
                            'sku' => 'ST.DOM11228SNI',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'DOMAE MCB 2P 4A C 230V 4500A',
                            'image' => 'DOMAE MCB 2P 4A C 230V 4500A.jpg',
                            'price' => 209550,
                            'sku' => 'ST.DOM11228SNI',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'DOMAE MCB C 6A 3P 4500A 400Vac  SNI',
                            'image' => 'DOMAE MCB C 6A 3P 4500A 400Vac  SNI.jpg',
                            'price' => 286000,
                            'sku' => 'ST.DOM11347SNI',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'DOMAE MCB C 10A 3P 4500A 400Vac  SNI',
                            'image' => 'DOMAE MCB C 10A 3P 4500A 400Vac  SNI.jpg',
                            'price' => 286000,
                            'sku' => 'ST.DOM11348SNI',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'DOMAE MCB 1P 2A C 230V 4500A',
                            'image' => 'DOMAE MCB 1P 2A C 230V 4500A.jpg',
                            'price' => 74800,
                            'sku' => 'ST.DOM12251SNI',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'DOMAE MCB 1P 4A C 230V 4500A',
                            'image' => 'DOMAE MCB 1P 4A C 230V 4500A.jpg',
                            'price' => 74800,
                            'sku' => 'ST.DOM12252SNI',
                            'varStock' => 100,
                        ]
                    ]
                ], //DOMAE MCB
                [
                    'name' => 'RCCB DOMAE',
                    'description' => 'RCCB DOMAE',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'ST.DOM16',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]ST.DOM16.jpg',
                            'size' => 14632,
                        ],
                        [
                            'filename' => '[1]ST.DOM16.jpg',
                            'size' => 14632,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 480150,
                            'max' => 518100,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'RCCB DOMAE 2P 25A 30MA AC',
                            'image' => 'ST.DOM16790.jpg',
                            'price' => 480150,
                            'sku' => 'ST.DOM16790',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'RCCB DOMAE 2P 40A 30MA AC',
                            'image' => 'ST.DOM16793.jpg',
                            'price' => 518100,
                            'sku' => 'ST.DOM16793',
                            'varStock' => 100,
                        ]
                    ]
                ], //RCCB DOMAE
                [
                    'name' => 'SOFT STARTER',
                    'description' => 'SOFT STARTER',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'HT.ATS',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]HT.ATS.jpg',
                            'size' => 31542,
                        ],
                        [
                            'filename' => '[1]HT.ATS.jpg',
                            'size' => 16731,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 10272900,
                            'max' => 11987800,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'SOFT STARTER 17A 440V 220V CTRL',
                            'image' => 'HT.ATS22D17Q.jpg',
                            'price' => 10272900,
                            'sku' => 'HT.ATS22D17Q',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'SOFT STARTER 32A 440V 220V CTRL',
                            'image' => 'HT.ATS22D32Q.jpg',
                            'price' => 11987800,
                            'sku' => 'HT.ATS22D32Q',
                            'varStock' => 100,
                        ]
                    ]
                ], //SOFT STARTER
                [
                    'name' => 'ACB MVS',
                    'description' => 'ACB MVS',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'ST.MVS',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]HT.ATSS.jpg',
                            'size' => 31542,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 22822800,
                            'max' => 46730200,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'ACB MVS, 800A, N, 3P, Manual, Fxd, ETA2I',
                            'image' => null,
                            'price' =>  22822800,
                            'sku' => 'ST.MVS08N3MF2A',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'ACB MVS 4P 800A D/O 50KA',
                            'image' => null,
                            'price' =>  46730200,
                            'sku' => 'ST.MVS08N4MD2A',
                            'varStock' => 100,
                        ]
                    ]
                ], //ACB MVS
                [
                    'name' => 'NW',
                    'description' => 'NW',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'ST.NW',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]ST.NW.jpg',
                            'size' => 25176,
                        ],
                        [
                            'filename' => '[1]ST.NW.jpg',
                            'size' => 25176,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 33189200,
                            'max' => 40359000,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'NW 800E H1 3P F/T MICRO 2.0E',
                            'image' => 'ST.NW08H13F2EH.jpg',
                            'price' =>   33189200,
                            'sku' => 'ST.NW08H13F2EH',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'NW 800A, H1, 4P, Fixed, 2.0E, Horizontal',
                            'image' => null,
                            'price' =>   40359000,
                            'sku' => 'ST.NW08H14F2EH',
                            'varStock' => 100,
                        ]
                    ]
                ], //NW
                [
                    'name' => 'ATV310',
                    'description' => 'ATV310',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'HT.ATV310',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]HT.ATV.jpg',
                            'size' => 15047,
                        ],
                        [
                            'filename' => '[1]HT.ATV.jpg',
                            'size' => 15047,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 3515600,
                            'max' => 3633300,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'ATV310 .37kW 3 Phase 380V',
                            'image' => 'HT.ATV310H037N4E.jpg',
                            'price' =>    3515600,
                            'sku' => 'HT.ATV310H037N4E',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'ATV310 .75kW 3 Phase 380V',
                            'image' => 'HT.ATV310H075N4E.jpg',
                            'price' =>    3633300,
                            'sku' => 'HT.ATV310H075N4E',
                            'varStock' => 100,
                        ]
                    ]
                ], //ATV310
                [
                    'name' => 'ATV630',
                    'description' => 'ATV630',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'HT.ATV630',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]HT.ATV630.jpg',
                            'size' => 12473,
                        ],
                        [
                            'filename' => '[1]HT.ATV630.jpg',
                            'size' => 12473,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 133890900,
                            'max' => 162979300,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'VARIABLE SPEED DRIVE IP00 110KW 400V/480',
                            'image' => 'HT.ATV630C11N4.jpg',
                            'price' =>     133890900,
                            'sku' => 'HT.ATV630C11N4',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'VARIABLE SPEED DRIVE IP00 132KW 400V/480',
                            'image' => 'HT.ATV630C13N4.jpg',
                            'price' =>     162979300,
                            'sku' => 'HT.ATV630C13N4',
                            'varStock' => 100,
                        ]
                    ]
                ], //ATV630
                [
                    'name' => 'NG125L',
                    'description' => 'NG125L',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'ST.18',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]HT.ATV6300.jpg',
                            'size' => 12473,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>  1047200,
                            'max' => 1047200,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'NG125L 1P 10A',
                            'image' => null,
                            'price' =>     1047200,
                            'sku' => 'ST.18777',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'NG125L 1P 16A',
                            'image' => null,
                            'price' =>     1047200,
                            'sku' => 'ST.18778',
                            'varStock' => 100,
                        ]
                    ]
                ], //NG125L
                [
                    'name' => 'ACTI9',
                    'description' => 'ACTI9',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'ST.A9',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]ST.A9.jpg',
                            'size' => 10561,
                        ],
                        [
                            'filename' => '[1]ST.A9.jpg',
                            'size' => 10561,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>   85250,
                            'max' => 85250,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'Acti9 iK60a 1P 6A C MCB',
                            'image' => 'ST.A9K14106.jpg',
                            'price' =>     85250,
                            'sku' => 'ST.A9K14106',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'Acti9 iK60a 1P 10A C MCB',
                            'image' => 'ST.A9K14110.jpg',
                            'price' =>     85250,
                            'sku' => 'ST.A9K14110',
                            'varStock' => 100,
                        ]
                    ]
                ], //ACTI9
                [
                    'name' => 'CIRCUIT BREAKER COMPACT',
                    'description' => 'CIRCUIT BREAKER COMPACT',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'ST.33',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]ST.33.jpg',
                            'size' => 22533,
                        ],
                        [
                            'filename' => '[1]ST.33.jpg',
                            'size' => 22533,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>    15364800,
                            'max' =>  20263100,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'CIRCUIT BREAKER COMPACT NS800N MICROLOGI',
                            'image' => 'ST.33466.jpg',
                            'price' =>     15364800,
                            'sku' => 'ST.33466',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'CIRCUIT BREAKER COMPACT NS800N MICROLOGI',
                            'image' => 'ST.33552.jpg',
                            'price' =>     20263100,
                            'sku' => 'ST.33552',
                            'varStock' => 100,
                        ]
                    ]
                ], //CIRCUIT BREAKER COMPACT
                [
                    'name' => 'NSX',
                    'description' => 'NSX',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'ST.LV',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]ST.LV.jpg',
                            'size' => 23304,
                        ],
                        [
                            'filename' => '[1]ST.LV.jpg',
                            'size' => 23304,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>     1420100,
                            'max' =>  1420100,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'EX3P3D TM25D NSX100F',
                            'image' => 'ST.LV429636.jpg',
                            'price' =>     1420100,
                            'sku' => 'ST.LV429636',
                            'varStock' => 100,
                        ],
                        [
                            'key' => '3P3D TM16D NSX100F',
                            'image' => 'ST.LV429637.jpg',
                            'price' =>     1420100,
                            'sku' => 'ST.LV429637',
                            'varStock' => 100,
                        ]
                    ]
                ], //NSX
                [
                    'name' => 'CVS',
                    'description' => 'CVS',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'ST.LV5',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]ST.LV5.jpg',
                            'size' => 24118,
                        ],
                        [
                            'filename' => '[1]ST.LV5.jpg',
                            'size' => 23739,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>      1424500,
                            'max' =>  1424500,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'CVS100B TM16D 4P3D',
                            'image' => 'ST.LV510310.jpg',
                            'price' =>     1424500,
                            'sku' => 'ST.LV510310',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'CVS100B TM25D 4P3D',
                            'image' => 'ST.LV510311.jpg',
                            'price' =>     1424500,
                            'sku' => 'ST.LV510311',
                            'varStock' => 100,
                        ]
                    ]
                ], //CVS
                [
                    'name' => 'XB4',
                    'description' => 'XB4',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'ST.XB',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]ST.XB.jpg',
                            'size' => 20489,
                        ],
                        [
                            'filename' => '[1]ST.XB.jpg',
                            'size' => 25212,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>   159100,
                            'max' =>  159100,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => '24 V LED PILOT LIGHT BODY',
                            'image' => 'ST.XB4BVB1.jpg',
                            'price' =>     159100,
                            'sku' => 'ST.XB4BVB1',
                            'varStock' => 100,
                        ],
                        [
                            'key' => '24 V LED PILOT LIGHT BODY',
                            'image' => 'ST.XB4BVB3.jpg',
                            'price' =>     159100,
                            'sku' => 'ST.XB4BVB3',
                            'varStock' => 100,
                        ]
                    ]
                ], //XB4
                [
                    'name' => 'XB5',
                    'description' => 'XB5',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'ST.XB5',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]ST.XB5.jpg',
                            'size' => 18878,
                        ],
                        [
                            'filename' => '[1]ST.XB5.jpg',
                            'size' => 19620,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>    56000,
                            'max' =>   56000,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'PUSHBUTTON',
                            'image' => 'ST.XB5AA31.jpg',
                            'price' =>     56000,
                            'sku' => 'ST.XB5AA21',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'PUSHBUTTON',
                            'image' => 'ST.XB5AA31.jpg',
                            'price' =>     56000,
                            'sku' => 'ST.XB5AA31',
                            'varStock' => 100,
                        ]
                    ]
                ], //XB5
                [
                    'name' => 'ACTI9 IID',
                    'description' => 'ACTI9 IID',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'ST.A9R',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]ST.A9R.jpg',
                            'size' => 14876,
                        ],
                        [
                            'filename' => '[1]ST.A9R.jpg',
                            'size' => 14876,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>    641850,
                            'max' =>   718850,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'ACTI9 IID 2P 25A 30MA AC-TYPE RESIDUAL C',
                            'image' => 'ST.A9R71225.jpg',
                            'price' =>      641850,
                            'sku' => 'ST.A9R71225',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'ACTI9 IID 2P 40A 30MA AC-TYPE RESIDUAL C',
                            'image' => 'ST.A9R71240.jpg',
                            'price' =>      718850,
                            'sku' => 'ST.A9R71240',
                            'varStock' => 100,
                        ]
                    ]
                ], //ACTI9 IID
                [
                    'name' => 'Mallia - RJ45 cat 5e - white - with frame',
                    'description' => 'Mallia - RJ45 cat 5e - white - with frame',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'LE.281161',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => 'LE.281161.jpg',
                            'size' => 18902,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>    136000,
                            'max' =>   136000,
                        ]
                    ],
                ], //MALLIA
                [
                    'name' => 'Mallia - RJ11 - Silver',
                    'description' => 'Mallia - RJ11 - Silver',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'LE.283160',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => 'LE.283160.jpg',
                            'size' => 35666,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>    165200,
                            'max' =>   165200,
                        ]
                    ]
                ], //MALLIA
                [
                    'name' => 'RX3 4500',
                    'description' => 'RX3 4500',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'LE.4',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]LE.4.jpg',
                            'size' => 11785,
                        ],
                        [
                            'filename' => '[1]LE.4.jpg',
                            'size' => 11785,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>     49000,
                            'max' =>   49000,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'RX3 MCB 1P C6 4500A',
                            'image' => 'LE.419661.jpg',
                            'price' =>      49000,
                            'sku' => 'LE.419661',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'RX3 MCB 1P C10 4500A',
                            'image' => 'LE.419662.jpg',
                            'price' =>      49000,
                            'sku' => 'LE.419662',
                            'varStock' => 100,
                        ]
                    ]
                ], //ACTI9 IID
                [
                    'name' => 'RX3 6000',
                    'description' => 'RX3 6000',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'LE.41',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]LE.41.jpg',
                            'size' => 11785,
                        ],
                        [
                            'filename' => '[1]LE.41.jpg',
                            'size' => 11785,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>      52500,
                            'max' =>   52500,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'RX3 MCB 1P C6 6000A',
                            'image' => 'LE.419837.jpg',
                            'price' =>      52500,
                            'sku' => 'LE.419837',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'RX3 MCB 1P C10 6000A',
                            'image' => 'LE.419838.jpg',
                            'price' =>      52500,
                            'sku' => 'LE.419838',
                            'varStock' => 100,
                        ]
                    ]
                ], //ACTI9 IID
                [
                    'name' => 'Mallia - 3G 1w 10A switch - white - with frame',
                    'description' => 'Mallia - 3G 1w 10A switch - white - with frame',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'LE.281004',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => 'LE.281004.jpg',
                            'size' => 34935,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>     132200,
                            'max' =>   132200,
                        ]
                    ]
                ], //MALLIA
                [
                    'name' => '3G 1G 20A 1W 2M SQ WH',
                    'description' => '3G 1G 20A 1W 2M SQ WH',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'LE.572043',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => 'LE.2810041.jpg',
                            'size' => 34935,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>      277000,
                            'max' =>   277000,
                        ]
                    ]
                ], //ARTEOR
                [
                    'name' => 'PLATE 1M SQ BS AR',
                    'description' => 'PLATE 1M SQ BS AR',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'LE.575200',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => 'LE.2810042.jpg',
                            'size' => 34935,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>       27000,
                            'max' =>   27000,
                        ]
                    ]
                ], //ARTEOR
                [
                    'name' => '1G 1WAY BIG ROCKER',
                    'description' => '1G 1WAY BIG ROCKER',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'LE.617000',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => 'LE.2810043.jpg',
                            'size' => 34935,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>       27600,
                            'max' =>    27600,
                        ]
                    ]
                ], //BELANKO
                [
                    'name' => 'Schuko socket outlet with CP 2P+E 16A',
                    'description' => 'Schuko socket outlet with CP 2P+E 16A',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'LE.617056',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => 'LE.2810044.jpg',
                            'size' => 34935,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 47200,
                            'max' => 47200,
                        ]
                    ]
                ], //BELANKO
                [
                    'name' => 'RJ45 CAT.5 UTP',
                    'description' => 'RJ45 CAT.5 UTP',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'LE.617090',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => 'LE.2810045.jpg',
                            'size' => 34935,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>  100500,
                            'max' => 100500,
                        ]
                    ]
                ], //BELANKO
                [
                    'name' => '^LEGRAND^  RIGID CONDUIT D25 WHITE',
                    'description' => '^LEGRAND^  RIGID CONDUIT D25 WHITE',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'LE.656502',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => 'LE.2810046.jpg',
                            'size' => 34935,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>   25800,
                            'max' => 25800,
                        ]
                    ]
                ], //25MM
                [
                    'name' => '^LEGRAND^  RIGID CONDUIT D20 WHITE',
                    'description' => '^LEGRAND^  RIGID CONDUIT D20 WHITE',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'LE.656513',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => 'LE.2810047.jpg',
                            'size' => 34935,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>    14800,
                            'max' => 14800,
                        ]
                    ]
                ], //25MM
                [
                    'name' => 'NILOE',
                    'description' => 'NILOE',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'LE.66',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]LE.411.jpg',
                            'size' => 11785,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>      6000,
                            'max' =>   19000,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => '1 GANG PLATE WHITE',
                            'image' => null,
                            'price' =>       6000,
                            'sku' => 'LE.665001',
                            'varStock' => 100,
                        ],
                        [
                            'key' => '2 GANGS PLATE WHITE',
                            'image' => null,
                            'price' =>       19000,
                            'sku' => 'LE.665002',
                            'varStock' => 100,
                        ]
                    ]
                ], //NILOE
                [
                    'name' => 'BMH',
                    'description' => 'BMH',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'PH.913',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.913.png',
                            'size' => 191373,
                        ],
                        [
                            'filename' => '[1]PH.913.png',
                            'size' => 189209,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 105100,
                            'max' => 120850,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'BMH 35L 302I TS',
                            'image' => 'PH.913710103150.png',
                            'price' => 105100,
                            'sku' => 'PH.913710103150',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'BMH 70L 302I TS',
                            'image' => 'PH.913710103250.png',
                            'price' => 120850,
                            'sku' => 'PH.913710103250',
                            'varStock' => 100,
                        ]
                    ]
                ], //BMH
                [
                    'name' => 'CLAS',
                    'description' => 'CLAS',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'PH.920',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.92.png',
                            'size' => 52044,
                        ],
                        [
                            'filename' => '[1]PH.92.png',
                            'size' => 30005,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 5000,
                            'max' => 7800,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'CLAS 75W E27 220-240V A55 CL 1CT/10X10F',
                            'image' => 'PH.920055543329.png',
                            'price' =>  5000,
                            'sku' => 'PH.920055543329',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'CLAS 60W E27 220-240V E50 W-W 1CT/10X10F',
                            'image' => 'PH.913710103250.png',
                            'price' =>  7800,
                            'sku' => 'PH.920236243329',
                            'varStock' => 100,
                        ]
                    ]
                ], //CLAS
                [
                    'name' => 'CAPSULE',
                    'description' => 'CAPSULE',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 300,
                    'sku' => 'PH.924',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.924.png',
                            'size' => 16442,
                        ],
                        [
                            'filename' => '[1]PH.924.png',
                            'size' => 16315,
                        ],
                        [
                            'filename' => '[2]PH.925.png',
                            'size' => 16300,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 4400,
                            'max' => 9550,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'Ess Capsule 50W GY6.35 12V CL 2BC/10',
                            'image' => 'PH.924062017181.png',
                            'price' =>   5350,
                            'sku' => 'PH.924062017181',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'Ess Capsule 50W GY6.35 12V CL 1CT/50',
                            'image' => 'PH.924062017182.png',
                            'price' =>   4400,
                            'sku' => 'PH.924062017182',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'ESS Capsule 40W G9 230V CL 1CT/50',
                            'image' => 'PH.925635844281.png',
                            'price' =>   9550,
                            'sku' => 'PH.925635844281',
                            'varStock' => 100,
                        ]
                    ]
                ], //CAPSULE
                [
                    'name' => 'DOWNLIGHT',
                    'description' => 'DOWNLIGHT',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 500,
                    'sku' => 'PH.910',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.91.png',
                            'size' => 45780,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 47650,
                            'max' => 79600,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'FBS125 C MAX 20W-E27 220-240V WH',
                            'image' => null,
                            'price' =>    70250,
                            'sku' => 'PH.910400900049',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'FBS125 C MAX 20W-E27 220-240V SI',
                            'image' => 'PH.910400900050.png',
                            'price' =>    79600,
                            'sku' => 'PH.910400900050',
                            'varStock' => 100,
                        ],
                        [
                            'key' => '13803 Glass recessed white 1x11W 230V',
                            'image' => null,
                            'price' =>    47650,
                            'sku' => 'PH.915004167101',
                            'varStock' => 100,
                        ],
                        [
                            'key' => '13804 Glass recessed white 1x18W 230V',
                            'image' => null,
                            'price' =>    58650,
                            'sku' => 'PH.915004167201',
                            'varStock' => 100,
                        ],
                        [
                            'key' => '13804 Glass recessed nickel 1x18W 230V',
                            'image' => null,
                            'price' =>    63750,
                            'sku' => 'PH.915004167301',
                            'varStock' => 100,
                        ]
                    ]
                ], //DOWNLIGHT
                [
                    'name' => 'WALL LAMP',
                    'description' => 'WALL LAMP',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'PH.915',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.9155.png',
                            'size' => 21883,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>  92250,
                            'max' => 92250,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => '01465 wall lantern black 1x60W 230V',
                            'image' => null,
                            'price' =>  92250,
                            'sku' => 'PH.915002238601',
                            'varStock' => 100,
                        ],
                        [
                            'key' => '01465 wall lantern white 1x60W 230V',
                            'image' => null,
                            'price' =>  92250,
                            'sku' => 'PH.915002238701',
                            'varStock' => 100,
                        ]
                    ]
                ], //WALL LAMP
                [
                    'name' => 'BVP',
                    'description' => 'BVP',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'PH.911',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.9156.png',
                            'size' => 21883,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>   3900000,
                            'max' => 3900000,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'BVP163 LED220/NW 220W 220-240V SWB',
                            'image' => null,
                            'price' =>  3900000,
                            'sku' => 'PH.911401687602',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'BVP163 LED220/CW 220W 220-240V SWB',
                            'image' => null,
                            'price' =>  3900000,
                            'sku' => 'PH.911401687802',
                            'varStock' => 100,
                        ]
                    ]
                ], //BVP
                [
                    'name' => 'BY118P',
                    'description' => 'BY118P',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 300,
                    'sku' => 'PH.9114',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.9114.png',
                            'size' => 13791,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 410000,
                            'max' => 500000,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'BY118P LED16/NW PSU',
                            'image' => null,
                            'price' =>    410000,
                            'sku' => 'PH.911401833299',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'BY118P LED16/CW PSU',
                            'image' => null,
                            'price' =>   410000,
                            'sku' => 'PH.911401833399',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'BY118P LED21/CW PSU',
                            'image' => 'PH.911401833699.png',
                            'price' =>    500000,
                            'sku' => 'PH.911401833699',
                            'varStock' => 100,
                        ]
                    ]
                ], //BY118P
                [
                    'name' => 'PENDANT LAMP',
                    'description' => 'PENDANT LAMP',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'PH.9150',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.915.png',
                            'size' => 21883,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>   139650,
                            'max' => 189500,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => '16119 Conesa pedestal black 1x24W',
                            'image' => 'PH.915005196601.png',
                            'price' =>   139650,
                            'sku' => 'PH.915005196601',
                            'varStock' => 100,
                        ],
                        [
                            'key' => '16117 Marcedo pedestal black 1x24W',
                            'image' => null,
                            'price' =>   189500,
                            'sku' => 'PH.915005196701',
                            'varStock' => 100,
                        ]
                    ]
                ], //PENDANT LAMP
                [
                    'name' => 'DN027B',
                    'description' => 'DN027B',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 300,
                    'sku' => 'PH.91140',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.91140.png',
                            'size' => 37322,
                        ],
                        [
                            'filename' => '[1]PH.91140.png',
                            'size' => 36940,
                        ],
                        [
                            'filename' => '[2]PH.91140.png',
                            'size' => 36942,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 110500,
                            'max' => 140250,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'DN027B LED6/WW D125 RD',
                            'image' => 'PH.911401810897.png',
                            'price' => 110500,
                            'sku' => 'PH.911401810897',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'DN027B LED9/WW D150 RD',
                            'image' => 'PH.911401811797.png',
                            'price' => 140250,
                            'sku' => 'PH.911401811797',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'DN027B LED9/CW D150 RD',
                            'image' => 'PH.911401811997.png',
                            'price' => 140250,
                            'sku' => 'PH.911401811997',
                            'varStock' => 100,
                        ]
                    ]
                ], //DN027B
                [
                    'name' => 'LEDBulb',
                    'description' => 'LEDBulb',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 300,
                    'sku' => 'PH.929',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.929.png',
                            'size' => 26183,
                        ],
                        [
                            'filename' => '[1]PH.929.png',
                            'size' => 26033,
                        ],
                        [
                            'filename' => '[2]PH.929.png',
                            'size' => 23800,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 36000,
                            'max' => 36000,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'LEDBulb 9.5-70W E27 3000K 230V A60',
                            'image' => 'PH.929001162237.png',
                            'price' => 36000,
                            'sku' => 'PH.929001162237',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'LEDBulb 9-70W E27 6500K 230V A60',
                            'image' => 'PH.929001163737.png',
                            'price' => 36000,
                            'sku' => 'PH.929001163737',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'LEDBulb 8-70W E27 6500K 230V A60 INDO',
                            'image' => 'PH.929001304887.png',
                            'price' => 36000,
                            'sku' => 'PH.929001304887',
                            'varStock' => 100,
                        ]
                    ]
                ], //LEDBulb
                [
                    'name' => 'LEDClassic',
                    'description' => 'LEDClassic',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'PH.9290',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.9290.png',
                            'size' => 30568,
                        ],
                        [
                            'filename' => '[1]PH.9290.png',
                            'size' => 30411,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>   26900,
                            'max' => 44900,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'LEDClassic 4.5-50W P45 E27 WW CL D APR',
                            'image' => 'PH.929001227608.png',
                            'price' => 44900,
                            'sku' => 'PH.929001227608',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'LEDClassic 2-25W P45 E27 WW CL ND APR',
                            'image' => 'PH.929001238708.png',
                            'price' => 26900,
                            'sku' => 'PH.929001238708',
                            'varStock' => 100,
                        ]
                    ]
                ], //LEDClassic
                [
                    'name' => 'BN010C',
                    'description' => 'BN010C',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 300,
                    'sku' => 'PH.ID',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.9291.png',
                            'size' => 30568,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>  59415,
                            'max' => 72165,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'BN010C 1xTLED/765 L1200 EN',
                            'image' => null,
                            'price' =>  72165,
                            'sku' => 'PH.IDA01B250011',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'BN010C 1xTLED/740 L1200 EN',
                            'image' => null,
                            'price' => 72165,
                            'sku' => 'PH.IDA01B250021',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'BN010C 1xTLED/740 L600 EN',
                            'image' => null,
                            'price' => 59415,
                            'sku' => 'PH.IDA01B250041',
                            'varStock' => 100,
                        ]
                    ]
                ], //BN010C
                [
                    'name' => 'AGILESTYLE',
                    'description' => 'AGILESTYLE',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'PH.9137',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.9292.png',
                            'size' => 30568,
                        ]
                    ],
                    'price' => [
                        [
                            'min' =>   3495,
                            'max' => 5900,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'AgileStyle 1M size 1 way switch',
                            'image' => null,
                            'price' =>  5900,
                            'sku' => 'PH.913713638301',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'AgileStyle 1M size blank',
                            'image' => null,
                            'price' =>  3495,
                            'sku' => 'PH.913713638401',
                            'varStock' => 100,
                        ]
                    ]
                ], //AGILESTYLE
                [
                    'name' => 'BRP022',
                    'description' => 'BRP022',
                    'weight' => [
                        [
                            'unit' => 'g',
                            'weight' => 0,
                        ]
                    ],
                    'stock' => 200,
                    'sku' => 'PH.9195',
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'image' => [
                        [
                            'filename' => '[0]PH.9293.png',
                            'size' => 30568,
                        ]
                    ],
                    'price' => [
                        [
                            'min' => 766650,
                            'max' => 1122000,
                        ]
                    ],
                    'variant' => [
                        [
                            'key' => 'BRP022 LED 10 CW MR S1 PSU GR',
                            'image' => null,
                            'price' => 766650,
                            'sku' => 'PH.919515810398',
                            'varStock' => 100,
                        ],
                        [
                            'key' => 'BRP022 LED 21 CW MR S1 PSU GR',
                            'image' => null,
                            'price' => 1122000,
                            'sku' => 'PH.919515810619',
                            'varStock' => 100,
                        ]
                    ]
                ], //BRP022
            ]
        );

        //add category
        $category = DB::table('categories')->whereIn('slug',['mcb','domae'])->get();
        DB::table('products')->whereIn('sku', ['ST.DOM'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['elcb','domae'])->get();
        DB::table('products')->whereIn('sku', ['ST.DOM16'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['soft-starter','ats22'])->get();
        DB::table('products')->whereIn('sku', ['HT.ATS'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['acb','mvs'])->get();
        DB::table('products')->whereIn('sku', ['ST.MVS'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['acb','nw'])->get();
        DB::table('products')->whereIn('sku', ['ST.NW'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['altivar','atv310'])->get();
        DB::table('products')->whereIn('sku', ['HT.ATV310'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['altivar','atv630'])->get();
        DB::table('products')->whereIn('sku', ['HT.ATV630'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['mcb','ng125l'])->get();
        DB::table('products')->whereIn('sku', ['ST.18'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['mcb','acti9'])->get();
        DB::table('products')->whereIn('sku', ['ST.A9'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['mccb','ns'])->get();
        DB::table('products')->whereIn('sku', ['ST.33'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['mccb','nsx'])->get();
        DB::table('products')->whereIn('sku', ['ST.LV'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['mccb','cvs'])->get();
        DB::table('products')->whereIn('sku', ['ST.LV5'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['pushbutton','xb4'])->get();
        DB::table('products')->whereIn('sku', ['ST.XB'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['pushbutton','xb5'])->get();
        DB::table('products')->whereIn('sku', ['ST.XB5'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['elcb','acti9'])->get();
        DB::table('products')->whereIn('sku', ['ST.A9R'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['sockets-data','mallia'])->get();
        DB::table('products')->whereIn('sku', ['LE.281161'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['sockets-telephone','mallia'])->get();
        DB::table('products')->whereIn('sku', ['LE.283160'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['mcb','rx3-4500'])->get();
        DB::table('products')->whereIn('sku', ['LE.4'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['mcb','rx3-6000'])->get();
        DB::table('products')->whereIn('sku', ['LE.41'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['switches','mallia'])->get();
        DB::table('products')->whereIn('sku', ['LE.281004'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['switches','arteor'])->get();
        DB::table('products')->whereIn('sku', ['LE.572043'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['cover','arteor'])->get();
        DB::table('products')->whereIn('sku', ['LE.575200'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['switches','belanko'])->get();
        DB::table('products')->whereIn('sku', ['LE.617000'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['socket-outlets','belanko'])->get();
        DB::table('products')->whereIn('sku', ['LE.617056'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['sockets-data','belanko'])->get();
        DB::table('products')->whereIn('sku', ['LE.617090'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['conduit','25mm'])->get();
        DB::table('products')->whereIn('sku', ['LE.656502'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['conduit','20mm'])->get();
        DB::table('products')->whereIn('sku', ['LE.656513'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['cover','niloe'])->get();
        DB::table('products')->whereIn('sku', ['LE.66'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['ballast','bmh'])->get();
        DB::table('products')->whereIn('sku', ['PH.913'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['bohlam','clas'])->get();
        DB::table('products')->whereIn('sku', ['PH.920'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['cfli','capsule'])->get();
        DB::table('products')->whereIn('sku', ['PH.924'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['confentional','downlight'])->get();
        DB::table('products')->whereIn('sku', ['PH.910'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['conslum','wall-lamp'])->get();
        DB::table('products')->whereIn('sku', ['PH.915'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['garden-light','bvp'])->get();
        DB::table('products')->whereIn('sku', ['PH.911'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['hight-bay','by'])->get();
        DB::table('products')->whereIn('sku', ['PH.9114'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['home','pendant-lamp'])->get();
        DB::table('products')->whereIn('sku', ['PH.9150'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['led','downlight'])->get();
        DB::table('products')->whereIn('sku', ['PH.91140'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['led','bulb'])->get();
        DB::table('products')->whereIn('sku', ['PH.929'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['led','classic'])->get();
        DB::table('products')->whereIn('sku', ['PH.9290'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['professional','bn'])->get();
        DB::table('products')->whereIn('sku', ['PH.ID'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['saklar','agilestyle'])->get();
        DB::table('products')->whereIn('sku', ['PH.9137'])->update(['categories' => $category->toArray()]);
        //add category
        $category = DB::table('categories')->whereIn('slug',['street-light','brp'])->get();
        DB::table('products')->whereIn('sku', ['PH.9195'])->update(['categories' => $category->toArray()]);
    }
}
