## Criando e Consumindo uma API Rest com Django e Wordpress
![Python](https://img.shields.io/badge/python-3670A0?style=for-the-badge&logo=python&logoColor=ffdd54)
![WordPress](https://img.shields.io/badge/WordPress-%23117AC9.svg?style=for-the-badge&logo=WordPress&logoColor=white)
![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![Django](https://img.shields.io/badge/django-%23092E20.svg?style=for-the-badge&logo=django&logoColor=white)
![Badge](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![Badge](https://img.shields.io/badge/CSS-239120?&style=for-the-badge&logo=css3&logoColor=white)
![Badge](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)


Criando uma API Rest utilizando Python e Django e consumindo os dados em uma aplicação Wordpress.
A idéia é entender como consumir uma aplicação REST e gravar estes dados em campos personalizados no Wordpress.


### Ferramentas utilizadas

- Django
- Python
- Wordpress
- Advanced Custom Fields (plugin WP)


### Visão Geral

Painel administrativo Django

![django-api](https://user-images.githubusercontent.com/87938869/190926519-ae43f862-dff2-4545-8f56-2de1d09c6800.jpg)

Adicionar novo servidor

![novo-servidor](https://user-images.githubusercontent.com/87938869/190926595-b2b6e39f-c5eb-493a-8109-57dee94a15f8.jpg)

Endpoint REST (lista de servidores via JSON)

![objetos-rest](https://user-images.githubusercontent.com/87938869/190926669-a4a10f53-600e-4020-8d26-b25de49f91e9.jpg)


Wordpress

Criação de campo personalizado utilizando plugin 'Advanced Custom Fields'

![campos](https://user-images.githubusercontent.com/87938869/190927730-d23d7051-d8ad-456f-8d52-fbc8b2688aa8.jpg)

![campos-wp](https://user-images.githubusercontent.com/87938869/190927754-6f6c1119-8a7b-4e35-86fa-dd4138ca1ebb.jpg)

Campo Servidores

![servidores-wp](https://user-images.githubusercontent.com/87938869/190927769-13da64dc-6949-4a6a-95d2-14c03510ca0c.jpg)

Dados gravados nos campos

![servidores-wp_2](https://user-images.githubusercontent.com/87938869/190927783-7c311d8a-6298-4ca3-9bdb-c3d75cd8a226.jpg)



### Functions.php

Registra novo tipo de  POST customizado

    function register_servidor() {
        register_post_type( 'servidor', array(
        'label' => 'Servidores',
        'public' => true,
        'capability_type' => 'post',
        ));
    }
    add_action( 'init', 'register_servidor' );


Verifica registros no BD

    function clear_servidores_from_db() {
        global $wpdb;

        $wpdb->query("DELETE FROM wp_posts WHERE post_type='servidor'");
        $wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts);");
        $wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");

    }

Chamada AJAX e registro dos dados nos campos personalizados

    add_action( 'update_servidor_list', 'get_servidores_from_api' );
    add_action( 'wp_ajax_nopriv_get_servidores_from_api', 'get_servidores_from_api' );
    add_action( 'wp_ajax_get_servidores_from_api', 'get_servidores_from_api' );
    function get_servidores_from_api() {

        $current_page = ( ! empty( $_POST['current_page'] ) ) ? $_POST['current_page'] : 1;
        $servidores = [];

        $results = wp_remote_retrieve_body( wp_remote_get('https://dgrh-servidores.herokuapp.com/api/list/?page=' . $current_page . '&per_page=50') );

        $results = json_decode( $results );  

        if( ! is_array( $results ) || empty( $results ) ){
            return false;
        }
 
        $servidores[] = $results;
 
        foreach( $servidores[0] as $servidor ){
     
        $servidor_slug = slugify( $servidor->nome . '-' . $servidor->id );    
 
        $existing_servidor = get_page_by_path( $servidor_slug, 'OBJECT', 'servidor' );
 
        if( $existing_servidor === null  ){
       
            $inserted_servidor = wp_insert_post( [
              'post_name' => $servidor_slug,
              'post_title' => $servidor_slug,
              'post_type' => 'servidor',
              'post_status' => 'publish'
        ] );
 
        if( is_wp_error( $inserted_servidor ) || $inserted_servidor === 0 ) {
              continue;
        }
            $fillable = [
             'field_6319426a6b084'=> 'nome',
                'field_631942776b085' => 'email',
                'field_631942806b086' => 'departamento',
                'field_6319428b6b087' => 'ramal',
                'field_631942936b088' => 'data_nascimento',
                'field_631942a46b089' => 'is_active',
           
        ];
 
        foreach( $fillable as $key => $nome ) {
            update_field( $key, $servidor->$nome, $inserted_servidor );
        }
 
       
      } else {
       
            $existing_servidor_id = $existing_servidor->id;
            $exisiting_servidor_timestamp = get_field('updated_at', $existing_servidor_id);
 
        if( $servidor->updated_at >= $exisiting_servidor_timestamp ){
 
              $fillable = [
                'field_6319426a6b084'=> 'nome',
                'field_631942776b085' => 'email',
                'field_631942806b086' => 'departamento',
                'field_6319428b6b087' => 'ramal',
                'field_631942936b088' => 'data_nascimento',
                'field_631942a46b089' => 'is_active',
          ];
 
          foreach( $fillable as $key => $nome ){
            update_field( $nome, $servidor->$nome, $existing_servidor_id);
          }
        }
      }
    }
   
    $current_page = $current_page + 1;
    wp_remote_post( admin_url('admin-ajax.php?action=get_servidores_from_api'), [
          'blocking' => false,
          'sslverify' => false, // we are sending this to ourselves, so trust it.
          'body' => [
            'current_page' => $current_page
      ]
    ] );

    }


### Créditos

- https://www.youtube.com/watch?v=LWM41Rcao3s&t=214s
- https://pt.wordpressask.com/consumindo-uma-api-externa-no-wordpress.html
- https://felipeelia.com.br/a-api-rest-do-wordpress
- https://kinsta.com/pt/blog/wordpress-rest-api/
