{composerEnv, fetchurl, fetchgit ? null, fetchhg ? null, fetchsvn ? null, noDev ? false}:

let
  packages = {};
  devPackages = {
    "cilex/cilex" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "cilex-cilex-7acd965a609a56d0345e8b6071c261fbdb926cb5";
        src = fetchurl {
          url = https://api.github.com/repos/Cilex/Cilex/zipball/7acd965a609a56d0345e8b6071c261fbdb926cb5;
          sha256 = "0hi8xfwkj7bj15mpaqxj06bngz4gk2idhkc9yxxr5k4x72swvhzp";
        };
      };
    };
    "cilex/console-service-provider" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "cilex-console-service-provider-25ee3d1875243d38e1a3448ff94bdf944f70d24e";
        src = fetchurl {
          url = https://api.github.com/repos/Cilex/console-service-provider/zipball/25ee3d1875243d38e1a3448ff94bdf944f70d24e;
          sha256 = "1g9zgx1hplkbhhqsci5l4m9j7mi6w6j6b32bg0sn3b9q3510damg";
        };
      };
    };
    "container-interop/container-interop" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "container-interop-container-interop-79cbf1341c22ec75643d841642dd5d6acd83bdb8";
        src = fetchurl {
          url = https://api.github.com/repos/container-interop/container-interop/zipball/79cbf1341c22ec75643d841642dd5d6acd83bdb8;
          sha256 = "1pxm461g5flcq50yabr01nw8w17n3g7klpman9ps3im4z0604m52";
        };
      };
    };
    "doctrine/annotations" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "doctrine-annotations-c7f2050c68a9ab0bdb0f98567ec08d80ea7d24d5";
        src = fetchurl {
          url = https://api.github.com/repos/doctrine/annotations/zipball/c7f2050c68a9ab0bdb0f98567ec08d80ea7d24d5;
          sha256 = "0b80xpqd3j99xgm0c41kbgy0k6knrfnd29223c93295sb12112g7";
        };
      };
    };
    "doctrine/instantiator" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "doctrine-instantiator-185b8868aa9bf7159f5f953ed5afb2d7fcdc3bda";
        src = fetchurl {
          url = https://api.github.com/repos/doctrine/instantiator/zipball/185b8868aa9bf7159f5f953ed5afb2d7fcdc3bda;
          sha256 = "1mah9a6mb30qad1zryzjain2dxw29d8h4bjkbcs3srpm3p891msy";
        };
      };
    };
    "doctrine/lexer" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "doctrine-lexer-83893c552fd2045dd78aef794c31e694c37c0b8c";
        src = fetchurl {
          url = https://api.github.com/repos/doctrine/lexer/zipball/83893c552fd2045dd78aef794c31e694c37c0b8c;
          sha256 = "0cyh3vwcl163cx1vrcwmhlh5jg9h47xwiqgzc6rwscxw0ppd1v74";
        };
      };
    };
    "erusev/parsedown" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "erusev-parsedown-92e9c27ba0e74b8b028b111d1b6f956a15c01fc1";
        src = fetchurl {
          url = https://api.github.com/repos/erusev/parsedown/zipball/92e9c27ba0e74b8b028b111d1b6f956a15c01fc1;
          sha256 = "1v7n9niys176acs8cn9lh6qlwaw62hmsvm76384k6jg24c1pyp0k";
        };
      };
    };
    "herrera-io/json" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "herrera-io-json-60c696c9370a1e5136816ca557c17f82a6fa83f1";
        src = fetchurl {
          url = https://api.github.com/repos/kherge-php/json/zipball/60c696c9370a1e5136816ca557c17f82a6fa83f1;
          sha256 = "1bx6rnrhvfn0ia2c95nhjk2mci0c4aj2s7ijqv0ihvda54abpws0";
        };
      };
    };
    "herrera-io/phar-update" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "herrera-io-phar-update-00a79e1d5b8cf3c080a2e3becf1ddf7a7fea025b";
        src = fetchurl {
          url = https://api.github.com/repos/kherge-abandoned/php-phar-update/zipball/00a79e1d5b8cf3c080a2e3becf1ddf7a7fea025b;
          sha256 = "0dz3pbba9b6x6l8rba36mxa75dy131j3pvjbgads5xibdzb6zsj0";
        };
      };
    };
    "jms/metadata" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "jms-metadata-6a06970a10e0a532fb52d3959547123b84a3b3ab";
        src = fetchurl {
          url = https://api.github.com/repos/schmittjoh/metadata/zipball/6a06970a10e0a532fb52d3959547123b84a3b3ab;
          sha256 = "0bmmgwgnphlsp5da9xjxmwky837k8fqyqrwcrfi37c2c32qm1h68";
        };
      };
    };
    "jms/parser-lib" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "jms-parser-lib-c509473bc1b4866415627af0e1c6cc8ac97fa51d";
        src = fetchurl {
          url = https://api.github.com/repos/schmittjoh/parser-lib/zipball/c509473bc1b4866415627af0e1c6cc8ac97fa51d;
          sha256 = "1jkgihdxc28vklqzp7zd6wvi6q9dsym1q8cig9x6rm0ws51fns85";
        };
      };
    };
    "jms/serializer" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "jms-serializer-e7c53477ff55c21d1b1db7d062edc050a24f465f";
        src = fetchurl {
          url = https://api.github.com/repos/schmittjoh/serializer/zipball/e7c53477ff55c21d1b1db7d062edc050a24f465f;
          sha256 = "0r2j91w8cjaaqfsg81l30cad8cw6ndgh38l4dk5x10az5mm086mp";
        };
      };
    };
    "justinrainbow/json-schema" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "justinrainbow-json-schema-cc84765fb7317f6b07bd8ac78364747f95b86341";
        src = fetchurl {
          url = https://api.github.com/repos/justinrainbow/json-schema/zipball/cc84765fb7317f6b07bd8ac78364747f95b86341;
          sha256 = "0hgk8yqis25ymjcn1nhvdmbk5rkbr0qdz4jqm84zr1rkk2v5ckv9";
        };
      };
    };
    "kherge/version" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "kherge-version-f07cf83f8ce533be8f93d2893d96d674bbeb7e30";
        src = fetchurl {
          url = https://api.github.com/repos/kherge-abandoned/Version/zipball/f07cf83f8ce533be8f93d2893d96d674bbeb7e30;
          sha256 = "18l6nv6n6m85ywcmzf1d7xqjb4by26fzyjhkfvkj82rahxqji036";
        };
      };
    };
    "monolog/monolog" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "monolog-monolog-fd8c787753b3a2ad11bc60c063cff1358a32a3b4";
        src = fetchurl {
          url = https://api.github.com/repos/Seldaek/monolog/zipball/fd8c787753b3a2ad11bc60c063cff1358a32a3b4;
          sha256 = "0avf3y8raw23krwdb7kw9qb5bsr5ls4i7qd2vh7hcds3qjixg3h9";
        };
      };
    };
    "myclabs/deep-copy" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "myclabs-deep-copy-3b8a3a99ba1f6a3952ac2747d989303cbd6b7a3e";
        src = fetchurl {
          url = https://api.github.com/repos/myclabs/DeepCopy/zipball/3b8a3a99ba1f6a3952ac2747d989303cbd6b7a3e;
          sha256 = "1mxn444j48gnk11pjm2b4ixxa8y6lcmrqslshm7zwqbl96k4mx48";
        };
      };
    };
    "nikic/php-parser" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "nikic-php-parser-f78af2c9c86107aa1a34cd1dbb5bbe9eeb0d9f51";
        src = fetchurl {
          url = https://api.github.com/repos/nikic/PHP-Parser/zipball/f78af2c9c86107aa1a34cd1dbb5bbe9eeb0d9f51;
          sha256 = "008iv40q92cldbfqs5bc9s11i0fpycjafv7s4wk4y6h5wrbf34qk";
        };
      };
    };
    "phpcollection/phpcollection" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpcollection-phpcollection-f2bcff45c0da7c27991bbc1f90f47c4b7fb434a6";
        src = fetchurl {
          url = https://api.github.com/repos/schmittjoh/php-collection/zipball/f2bcff45c0da7c27991bbc1f90f47c4b7fb434a6;
          sha256 = "0bfbg7bs7q3wmyl3kp3vqshcj0pklj14z1vlxk4ymxrjzxwmb8my";
        };
      };
    };
    "phpdocumentor/fileset" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpdocumentor-fileset-bfa78d8fa9763dfce6d0e5d3730c1d8ab25d34b0";
        src = fetchurl {
          url = https://api.github.com/repos/phpDocumentor/Fileset/zipball/bfa78d8fa9763dfce6d0e5d3730c1d8ab25d34b0;
          sha256 = "0ncvq8zfnr3azzpw0navm2lk9w0dskk7mar2m4immzxyip00gp89";
        };
      };
    };
    "phpdocumentor/graphviz" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpdocumentor-graphviz-a906a90a9f230535f25ea31caf81b2323956283f";
        src = fetchurl {
          url = https://api.github.com/repos/phpDocumentor/GraphViz/zipball/a906a90a9f230535f25ea31caf81b2323956283f;
          sha256 = "06y7pha2nrki27k2jdpb4l1px5ngpwlwrmgg6lcxlzp4brf1q7ds";
        };
      };
    };
    "phpdocumentor/phpdocumentor" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpdocumentor-phpdocumentor-be607da0eef9b9249c43c5b4820d25d631c73667";
        src = fetchurl {
          url = https://api.github.com/repos/phpDocumentor/phpDocumentor2/zipball/be607da0eef9b9249c43c5b4820d25d631c73667;
          sha256 = "1gkvxw5q8fi2rpvc2g31n3bpywwcxjx2p1ickkd40bnvj9qw5wh1";
        };
      };
    };
    "phpdocumentor/reflection" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpdocumentor-reflection-793bfd92d9a0fc96ae9608fb3e947c3f59fb3a0d";
        src = fetchurl {
          url = https://api.github.com/repos/phpDocumentor/Reflection/zipball/793bfd92d9a0fc96ae9608fb3e947c3f59fb3a0d;
          sha256 = "1k2hbcjkiyyb8yzw9682i4i0bnrdzfapj6qhh4idn2d80bqzgkir";
        };
      };
    };
    "phpdocumentor/reflection-docblock" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpdocumentor-reflection-docblock-e6a969a640b00d8daa3c66518b0405fb41ae0c4b";
        src = fetchurl {
          url = https://api.github.com/repos/phpDocumentor/ReflectionDocBlock/zipball/e6a969a640b00d8daa3c66518b0405fb41ae0c4b;
          sha256 = "0hgrmgcdi9qadwsjcplg6lfjjwdjfajd2vm97bd0jkh0ykrxqghs";
        };
      };
    };
    "phpoption/phpoption" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpoption-phpoption-94e644f7d2051a5f0fcf77d81605f152eecff0ed";
        src = fetchurl {
          url = https://api.github.com/repos/schmittjoh/php-option/zipball/94e644f7d2051a5f0fcf77d81605f152eecff0ed;
          sha256 = "0vl5di2k4fypy1698hl86yjchlkcc8wacrgzlk6z66szf9xnn3nc";
        };
      };
    };
    "phpspec/prophecy" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpspec-prophecy-33a7e3c4fda54e912ff6338c48823bd5c0f0b712";
        src = fetchurl {
          url = https://api.github.com/repos/phpspec/prophecy/zipball/33a7e3c4fda54e912ff6338c48823bd5c0f0b712;
          sha256 = "1q93am752vhh90mc3af42prw2vr5f1baqn8g952p3qhyicnsz7qz";
        };
      };
    };
    "phpunit/php-code-coverage" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpunit-php-code-coverage-ef7b2f56815df854e66ceaee8ebe9393ae36a40d";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/php-code-coverage/zipball/ef7b2f56815df854e66ceaee8ebe9393ae36a40d;
          sha256 = "0i6lbr08g63vzd0dh1ax6b0x8m86r79ia7iggx6k42898332qgw3";
        };
      };
    };
    "phpunit/php-file-iterator" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpunit-php-file-iterator-730b01bc3e867237eaac355e06a36b85dd93a8b4";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/php-file-iterator/zipball/730b01bc3e867237eaac355e06a36b85dd93a8b4;
          sha256 = "0kbg907g9hrx7pv8v0wnf4ifqywdgvigq6y6z00lyhgd0b8is060";
        };
      };
    };
    "phpunit/php-text-template" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpunit-php-text-template-31f8b717e51d9a2afca6c9f046f5d69fc27c8686";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/php-text-template/zipball/31f8b717e51d9a2afca6c9f046f5d69fc27c8686;
          sha256 = "1y03m38qqvsbvyakd72v4dram81dw3swyn5jpss153i5nmqr4p76";
        };
      };
    };
    "phpunit/php-timer" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpunit-php-timer-3dcf38ca72b158baf0bc245e9184d3fdffa9c46f";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/php-timer/zipball/3dcf38ca72b158baf0bc245e9184d3fdffa9c46f;
          sha256 = "1j04r0hqzrv6m1jk5nb92k2nnana72nscqpfk3rgv3fzrrv69ljr";
        };
      };
    };
    "phpunit/php-token-stream" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpunit-php-token-stream-791198a2c6254db10131eecfe8c06670700904db";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/php-token-stream/zipball/791198a2c6254db10131eecfe8c06670700904db;
          sha256 = "03i9259r9mjib2ipdkavkq6di66mrsga6kzc7rq5pglrhfiiil4s";
        };
      };
    };
    "phpunit/phpunit" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpunit-phpunit-b7803aeca3ccb99ad0a506fa80b64cd6a56bbc0c";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/phpunit/zipball/b7803aeca3ccb99ad0a506fa80b64cd6a56bbc0c;
          sha256 = "0m3bimpkv0cw4l35mnqzda50yhg8zgikfliq9lmdf36wda00rri7";
        };
      };
    };
    "phpunit/phpunit-mock-objects" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "phpunit-phpunit-mock-objects-a23b761686d50a560cc56233b9ecf49597cc9118";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/phpunit-mock-objects/zipball/a23b761686d50a560cc56233b9ecf49597cc9118;
          sha256 = "19sa45fzw9fhjdl470i444y64iymhdad7hmlx9q54qjh9y6fy8gk";
        };
      };
    };
    "pimple/pimple" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "pimple-pimple-2019c145fe393923f3441b23f29bbdfaa5c58c4d";
        src = fetchurl {
          url = https://api.github.com/repos/silexphp/Pimple/zipball/2019c145fe393923f3441b23f29bbdfaa5c58c4d;
          sha256 = "17rnqcfmdr7lfvqprcnn3cbldj37gi9d7g8rjz6lzr813cj9q826";
        };
      };
    };
    "psr/cache" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "psr-cache-d11b50ad223250cf17b86e38383413f5a6764bf8";
        src = fetchurl {
          url = https://api.github.com/repos/php-fig/cache/zipball/d11b50ad223250cf17b86e38383413f5a6764bf8;
          sha256 = "06i2k3dx3b4lgn9a4v1dlgv8l9wcl4kl7vzhh63lbji0q96hv8qz";
        };
      };
    };
    "psr/container" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "psr-container-b7ce3b176482dbbc1245ebf52b181af44c2cf55f";
        src = fetchurl {
          url = https://api.github.com/repos/php-fig/container/zipball/b7ce3b176482dbbc1245ebf52b181af44c2cf55f;
          sha256 = "0rkz64vgwb0gfi09klvgay4qnw993l1dc03vyip7d7m2zxi6cy4j";
        };
      };
    };
    "psr/log" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "psr-log-4ebe3a8bf773a19edfe0a84b6585ba3d401b724d";
        src = fetchurl {
          url = https://api.github.com/repos/php-fig/log/zipball/4ebe3a8bf773a19edfe0a84b6585ba3d401b724d;
          sha256 = "1mlcv17fjw39bjpck176ah1z393b6pnbw3jqhhrblj27c70785md";
        };
      };
    };
    "psr/simple-cache" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "psr-simple-cache-408d5eafb83c57f6365a3ca330ff23aa4a5fa39b";
        src = fetchurl {
          url = https://api.github.com/repos/php-fig/simple-cache/zipball/408d5eafb83c57f6365a3ca330ff23aa4a5fa39b;
          sha256 = "1djgzclkamjxi9jy4m9ggfzgq1vqxaga2ip7l3cj88p7rwkzjxgw";
        };
      };
    };
    "sebastian/code-unit-reverse-lookup" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-code-unit-reverse-lookup-4419fcdb5eabb9caa61a27c7a1db532a6b55dd18";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/code-unit-reverse-lookup/zipball/4419fcdb5eabb9caa61a27c7a1db532a6b55dd18;
          sha256 = "0n0bygv2vx1l7af8szbcbn5bpr4axrgvkzd0m348m8ckmk8akvs8";
        };
      };
    };
    "sebastian/comparator" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-comparator-2b7424b55f5047b47ac6e5ccb20b2aea4011d9be";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/comparator/zipball/2b7424b55f5047b47ac6e5ccb20b2aea4011d9be;
          sha256 = "0ymarxgnr8b3iy0w18h5z13iiv0ja17vjryryzfcwlqqhlc6w7iq";
        };
      };
    };
    "sebastian/diff" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-diff-7f066a26a962dbe58ddea9f72a4e82874a3975a4";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/diff/zipball/7f066a26a962dbe58ddea9f72a4e82874a3975a4;
          sha256 = "1ppx21vjj79z6d584ryq451k7kvdc511awmqjkj9g4vxj1s1h3j6";
        };
      };
    };
    "sebastian/environment" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-environment-5795ffe5dc5b02460c3e34222fee8cbe245d8fac";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/environment/zipball/5795ffe5dc5b02460c3e34222fee8cbe245d8fac;
          sha256 = "0z1zv8v7k2cycw3vzilpbs7y3mjpwdzcspzgl6pbzi8rj7f4a93l";
        };
      };
    };
    "sebastian/exporter" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-exporter-ce474bdd1a34744d7ac5d6aad3a46d48d9bac4c4";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/exporter/zipball/ce474bdd1a34744d7ac5d6aad3a46d48d9bac4c4;
          sha256 = "1g8b7nm7f5dk7rkxhv3l6pclb95az28gi0j5g3inymysa95myh5d";
        };
      };
    };
    "sebastian/global-state" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-global-state-bc37d50fea7d017d3d340f230811c9f1d7280af4";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/global-state/zipball/bc37d50fea7d017d3d340f230811c9f1d7280af4;
          sha256 = "0y1x16mf9q38s7rlc7k2s6sxn2ccxmyk1q5zgh24hr4yp035f0pb";
        };
      };
    };
    "sebastian/object-enumerator" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-object-enumerator-1311872ac850040a79c3c058bea3e22d0f09cbb7";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/object-enumerator/zipball/1311872ac850040a79c3c058bea3e22d0f09cbb7;
          sha256 = "0f4vdgpq2alsj43bap0sarr79fxnzwpddq96kd18kgfl6n6m730y";
        };
      };
    };
    "sebastian/recursion-context" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-recursion-context-2c3ba150cbec723aa057506e73a8d33bdb286c9a";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/recursion-context/zipball/2c3ba150cbec723aa057506e73a8d33bdb286c9a;
          sha256 = "0rfa6qwayrlzaf4ycwm10m870bmzq152w1rn7wp4vrm283zkf4cs";
        };
      };
    };
    "sebastian/resource-operations" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-resource-operations-ce990bb21759f94aeafd30209e8cfcdfa8bc3f52";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/resource-operations/zipball/ce990bb21759f94aeafd30209e8cfcdfa8bc3f52;
          sha256 = "19jfc8xzkyycglrcz85sv3ajmxvxwkw4sid5l4i8g6wmz9npbsxl";
        };
      };
    };
    "sebastian/version" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "sebastian-version-99732be0ddb3361e16ad77b68ba41efc8e979019";
        src = fetchurl {
          url = https://api.github.com/repos/sebastianbergmann/version/zipball/99732be0ddb3361e16ad77b68ba41efc8e979019;
          sha256 = "0wrw5hskz2hg5aph9r1fhnngfrcvhws1pgs0lfrwindy066z6fj7";
        };
      };
    };
    "seld/jsonlint" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "seld-jsonlint-d15f59a67ff805a44c50ea0516d2341740f81a38";
        src = fetchurl {
          url = https://api.github.com/repos/Seldaek/jsonlint/zipball/d15f59a67ff805a44c50ea0516d2341740f81a38;
          sha256 = "1yd37g3c9gjk6d0qpd12xrlgd9mfvndv69h41n6fasvr1ags4ya1";
        };
      };
    };
    "symfony/config" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-config-ecacddeaf76732231eea1657f6f5b062dade94c9";
        src = fetchurl {
          url = https://api.github.com/repos/symfony/config/zipball/ecacddeaf76732231eea1657f6f5b062dade94c9;
          sha256 = "10dy35zkm5nmq1ik7gnrrz49xgv54pfzih5xvcjjqmnvlycb0sli";
        };
      };
    };
    "symfony/console" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-console-932d1e4f7f33ee37d3534f5f452474daa66283c2";
        src = fetchurl {
          url = https://api.github.com/repos/symfony/console/zipball/932d1e4f7f33ee37d3534f5f452474daa66283c2;
          sha256 = "08ik7rm1z8k1ar19z826rj9j23dy4wf43n0k79rzrbm5mj7nq78f";
        };
      };
    };
    "symfony/debug" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-debug-697c527acd9ea1b2d3efac34d9806bf255278b0a";
        src = fetchurl {
          url = https://api.github.com/repos/symfony/debug/zipball/697c527acd9ea1b2d3efac34d9806bf255278b0a;
          sha256 = "00d4kbzswrymand3rrhyc173fs26x55d38bvs17d5y6bk5glr6q1";
        };
      };
    };
    "symfony/event-dispatcher" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-event-dispatcher-9b69aad7d4c086dc94ebade2d5eb9145da5dac8c";
        src = fetchurl {
          url = https://api.github.com/repos/symfony/event-dispatcher/zipball/9b69aad7d4c086dc94ebade2d5eb9145da5dac8c;
          sha256 = "16zfkn3yw6nbkvc6sk5i7rp38hpda602499zvvys3l1hcx4cc2b2";
        };
      };
    };
    "symfony/filesystem" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-filesystem-b2da5009d9bacbd91d83486aa1f44c793a8c380d";
        src = fetchurl {
          url = https://api.github.com/repos/symfony/filesystem/zipball/b2da5009d9bacbd91d83486aa1f44c793a8c380d;
          sha256 = "1ijgs2yj900q26f1dr81nbb1s3hjmhzh4pap13145r71acjh7q37";
        };
      };
    };
    "symfony/finder" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-finder-423746fc18ccf31f9abec43e4f078bb6e024b2d5";
        src = fetchurl {
          url = https://api.github.com/repos/symfony/finder/zipball/423746fc18ccf31f9abec43e4f078bb6e024b2d5;
          sha256 = "15sifnvg12qsy9dmvl10f5ziygw0pkm1ws4v3bqqan1a1hdgg3d2";
        };
      };
    };
    "symfony/polyfill-mbstring" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-polyfill-mbstring-3296adf6a6454a050679cde90f95350ad604b171";
        src = fetchurl {
          url = https://api.github.com/repos/symfony/polyfill-mbstring/zipball/3296adf6a6454a050679cde90f95350ad604b171;
          sha256 = "02wyx9fjx9lyc5q5d3bnn8aw9xag8im2wqanmbkljwd5vmx9k9b2";
        };
      };
    };
    "symfony/process" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-process-ee2c91470ff262b1a00aec27875d38594aa87629";
        src = fetchurl {
          url = https://api.github.com/repos/symfony/process/zipball/ee2c91470ff262b1a00aec27875d38594aa87629;
          sha256 = "1p4jz6fr71kd4bc9hpmdywvgdpjm3ryh8dkfjwrix71q5v5wzkd3";
        };
      };
    };
    "symfony/stopwatch" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-stopwatch-57021208ad9830f8f8390c1a9d7bb390f32be89e";
        src = fetchurl {
          url = https://api.github.com/repos/symfony/stopwatch/zipball/57021208ad9830f8f8390c1a9d7bb390f32be89e;
          sha256 = "1x0sfv12wy8zg44xqkgii7p60vn3cab33zi0clcg8qpnx73qx40b";
        };
      };
    };
    "symfony/translation" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-translation-eee6c664853fd0576f21ae25725cfffeafe83f26";
        src = fetchurl {
          url = https://api.github.com/repos/symfony/translation/zipball/eee6c664853fd0576f21ae25725cfffeafe83f26;
          sha256 = "1l6nxk7ik8a0hj9lrxgbzwi07xiwm9aai1yd4skswnb0r3qbbxzq";
        };
      };
    };
    "symfony/validator" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-validator-1f7dbc5387c6cae22c44116c15638d6d9ac957d0";
        src = fetchurl {
          url = https://api.github.com/repos/symfony/validator/zipball/1f7dbc5387c6cae22c44116c15638d6d9ac957d0;
          sha256 = "1rxqiz8y9i858a8bih31inl0rg0ma6k1pz1ja3ibfi48mj8wrcm6";
        };
      };
    };
    "symfony/yaml" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "symfony-yaml-af615970e265543a26ee712c958404eb9b7ac93d";
        src = fetchurl {
          url = https://api.github.com/repos/symfony/yaml/zipball/af615970e265543a26ee712c958404eb9b7ac93d;
          sha256 = "1m1m11s44f0zy100n76pzi23wbwyn7rm2l8rdhnpjp0d8c05i3rj";
        };
      };
    };
    "twig/twig" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "twig-twig-b48680b6eb7d16b5025b9bfc4108d86f6b8af86f";
        src = fetchurl {
          url = https://api.github.com/repos/twigphp/Twig/zipball/b48680b6eb7d16b5025b9bfc4108d86f6b8af86f;
          sha256 = "1q82f246wq7whl11lx00n0skwmllppvpzg20x6q4frmw44dc6v9a";
        };
      };
    };
    "zendframework/zend-cache" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "zendframework-zend-cache-4983dff629956490c78b88adcc8ece4711d7d8a3";
        src = fetchurl {
          url = https://api.github.com/repos/zendframework/zend-cache/zipball/4983dff629956490c78b88adcc8ece4711d7d8a3;
          sha256 = "0hl9lrhdpq4mxi7l8ca3xzmmkiyfr1iwgsr6fg6vwcppmbhnibk9";
        };
      };
    };
    "zendframework/zend-config" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "zendframework-zend-config-2920e877a9f6dca9fa8f6bd3b1ffc2e19bb1e30d";
        src = fetchurl {
          url = https://api.github.com/repos/zendframework/zend-config/zipball/2920e877a9f6dca9fa8f6bd3b1ffc2e19bb1e30d;
          sha256 = "1gv5pcv7hclyk77sfc722w7qhxkgpz42wayj7nmqfjda0i6ka8fy";
        };
      };
    };
    "zendframework/zend-eventmanager" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "zendframework-zend-eventmanager-a5e2583a211f73604691586b8406ff7296a946dd";
        src = fetchurl {
          url = https://api.github.com/repos/zendframework/zend-eventmanager/zipball/a5e2583a211f73604691586b8406ff7296a946dd;
          sha256 = "08a05gn40hfdy2zhz4gcd3r6q7m7zcaks5kpvb9dx1awgx0pzr8n";
        };
      };
    };
    "zendframework/zend-filter" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "zendframework-zend-filter-7b997dbe79459f1652deccc8786d7407fb66caa9";
        src = fetchurl {
          url = https://api.github.com/repos/zendframework/zend-filter/zipball/7b997dbe79459f1652deccc8786d7407fb66caa9;
          sha256 = "1806q65kfjgn384l2a6ch2s7jy6xvdkh53r88990qp85cbk4755f";
        };
      };
    };
    "zendframework/zend-hydrator" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "zendframework-zend-hydrator-22652e1661a5a10b3f564cf7824a2206cf5a4a65";
        src = fetchurl {
          url = https://api.github.com/repos/zendframework/zend-hydrator/zipball/22652e1661a5a10b3f564cf7824a2206cf5a4a65;
          sha256 = "1wys4x4bw2i83h85wirl4b8l2pszzyr0d067mn6h7njipkqdn0dp";
        };
      };
    };
    "zendframework/zend-i18n" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "zendframework-zend-i18n-cfdb658121e0d7eb969a498c2f67f1eacaab9c63";
        src = fetchurl {
          url = https://api.github.com/repos/zendframework/zend-i18n/zipball/cfdb658121e0d7eb969a498c2f67f1eacaab9c63;
          sha256 = "0fhsg1hngcdnvw2r9iq33z7pvcssqwx5a0zicx2slg3si0mqq4bd";
        };
      };
    };
    "zendframework/zend-json" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "zendframework-zend-json-4dd940e8e6f32f1d36ea6b0677ea57c540c7c19c";
        src = fetchurl {
          url = https://api.github.com/repos/zendframework/zend-json/zipball/4dd940e8e6f32f1d36ea6b0677ea57c540c7c19c;
          sha256 = "09mmxcycy9vxykfv0lf2b7g0cspy1lmf01a1gmk98ny38knn7342";
        };
      };
    };
    "zendframework/zend-serializer" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "zendframework-zend-serializer-7ac42b9a47e9cb23895173a3096bc3b3fb7ac580";
        src = fetchurl {
          url = https://api.github.com/repos/zendframework/zend-serializer/zipball/7ac42b9a47e9cb23895173a3096bc3b3fb7ac580;
          sha256 = "0jpp5bbiisrhw6qppzmas46znmzkpyppgs2fz1xknl9qrvm43z9k";
        };
      };
    };
    "zendframework/zend-servicemanager" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "zendframework-zend-servicemanager-ba7069c94c9af93122be9fa31cddd37f7707d5b4";
        src = fetchurl {
          url = https://api.github.com/repos/zendframework/zend-servicemanager/zipball/ba7069c94c9af93122be9fa31cddd37f7707d5b4;
          sha256 = "09ygbiwx8pmf55fg4682m4k07r3hhvkqb7gg7j2cn743xpi3126r";
        };
      };
    };
    "zendframework/zend-stdlib" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "zendframework-zend-stdlib-0e44eb46788f65e09e077eb7f44d2659143bcc1f";
        src = fetchurl {
          url = https://api.github.com/repos/zendframework/zend-stdlib/zipball/0e44eb46788f65e09e077eb7f44d2659143bcc1f;
          sha256 = "0i4cds0qql22fj2bipkcpv9pc30s63h10gr15kh8k6jxd04ln2fn";
        };
      };
    };
    "zetacomponents/base" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "zetacomponents-base-489e20235989ddc97fdd793af31ac803972454f1";
        src = fetchurl {
          url = https://api.github.com/repos/zetacomponents/Base/zipball/489e20235989ddc97fdd793af31ac803972454f1;
          sha256 = "0fwzbz6a47l0lmfw52rvmbd1fds06vdwjpmvgkivgqmzp8r87zl5";
        };
      };
    };
    "zetacomponents/document" = {
      targetDir = "";
      src = composerEnv.buildZipPackage {
        name = "zetacomponents-document-688abfde573cf3fe0730f82538fbd7aa9fc95bc8";
        src = fetchurl {
          url = https://api.github.com/repos/zetacomponents/Document/zipball/688abfde573cf3fe0730f82538fbd7aa9fc95bc8;
          sha256 = "15bxwfcd934c41lw1ccmdypn4m1xq0p540x2bfcsc80m6d51nnll";
        };
      };
    };
  };
in
composerEnv.buildPackage {
  inherit packages devPackages noDev;
  name = "svanderburg-php-sblayout";
  src = ./.;
  executable = false;
  symlinkDependencies = false;
  meta = {
    license = "Apache-2.0";
  };
}