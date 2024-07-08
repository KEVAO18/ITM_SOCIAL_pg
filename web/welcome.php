<h2>
        Usuarios
    </h2>
    <h3>
        Get All
    </h3>
    <code>
        <?php

        use App\Model\usuarios as usuarios;

        $usuarios = new usuarios();

        // print_r($usuarios->save(2, 'Lucas', 'Luck', 'lucas@pruebas.com', '12345678', '2021-10-10', '{}', 0));

        $usuario = $usuarios->find("carnet = 5");

        if ($usuario) {
            echo $usuario->toJson();
        } else {
            echo "No se encontró el usuario";
        }

        // foreach ($usuarios->getAll() as $usuario) {
        //     print_r($usuario->toJson());
        // }
        ?>
    </code>
    <hr>
    <h2>
        Tipos de credenciales
    </h2>
    <h3>
        Get All
    </h3>
    <code>
        <?php

        use App\Model\tipos_de_credencial as tp;

        $tps = new tp();

        foreach ($tps->getAll() as $tp) {
            print_r($tp->toJson());
        }
        ?>
    </code>
    <hr>
    <h2>
        Credenciales
    </h2>
    <h3>
        Get All
    </h3>
    <code>
        <?php

        use App\Model\credenciales as c;

        $cs = new c();

        foreach ($cs->getAll() as $c) {
            print_r($c->toJson());
        }
        ?>
    </code>
    <h2>
        Comunidades
    </h2>
    <h3>
        Get All
    </h3>
    <code>
        <?php

            use App\Model\comunidades as coms;

            $coms = new coms();

            foreach ($coms->getAll() as $com) {
                print_r($com->toJson());
            }
        ?>
    </code>
    <hr>
    <h2>
        Posts
    </h2>
    <h3>
        Get All
    </h3>
    <code>
        <?php

            use App\Model\post;

            $posts = new post();

            foreach ($posts->getAll() as $post) {
                print_r($post->toJson());
            }
        ?>
    </code>
    <hr>
    <h2>
        Comentarios
    </h2>
    <h3>
        Get All
    </h3>
    <code>
        <?php

            use App\Model\comentarios as comes;

            $comes = new comes();

            foreach ($comes->getAll() as $come) {
                print_r($come->toJson());
            }
        ?>
    </code>
    <hr>
    <h2>
        Eventos
    </h2>
    <h3>
        Get All
    </h3>
    <code>
        <?php

            use App\Model\eventos as evs;

            $evs = new evs();

            foreach ($evs->getAll() as $ev) {
                print_r($ev->toJson());
            }
        ?>
    </code>
    <hr>
    <h2>
        chats
    </h2>
    <h3>
        Get All
    </h3>
    <code>
        <?php

            use App\Model\chats as chs;

            $chs = new chs();

            foreach ($chs->getAll() as $ch) {
                print_r($ch->toJson());
            }
        ?>
    </code>
    <hr>
    <h2>
        mensajes
    </h2>
    <h3>
        Get All
    </h3>
    <code>
        <?php

            use App\Model\mensajes as msjs;

            $msjs = new msjs();

            foreach ($msjs->getAll() as $msj) {
                print_r($msj->toJson());
            }
        ?>
    </code>
    <hr>
    <h2>
        usuarios en chat
    </h2>
    <h3>
        Get All
    </h3>
    <code>
        <?php

            use App\Model\usuarios_en_chat as uch;

            $uch = new uch();

            foreach ($uch->getAll() as $uc) {
                print_r($uc->toJson());
            }
        ?>
    </code>