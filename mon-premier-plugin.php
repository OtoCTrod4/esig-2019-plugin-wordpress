<?php
/*
Plugin Name: Mon Premier Plugin
*/

//Fonction qui affiche la balise meta
function mon_premier_plugin_meta_keywords() {
    echo '<meta name="keywords" content="HTML,CSS,XML,JavaScript">';
}
//Ajout d'une action sur 'wp_head' qui appellera mon_premier_plugin_meta_keywords()
add_action('wp_head', 'mon_premier_plugin_meta_keywords' );

//Fonction qui envoie par email les infos d'un email supprimé
function mon_premier_plugin_post_delete_mail($post_id) {
    //Récupére les informations de l'article supprimé
    $post = get_post($post_id);
    //Création du sujet de l'email
    $sujet = "Artile supprimé :" . $post->post_title;
    //Création du contenu de l'email
    $message = "Contenu de l'artilce : " . $post->post_content;
    //Envoi de l'email à l'administrateur du site
    wp_mail(get_bloginfo('admin_email'), $sujet, $message);
}
//Ajout d'une action sur 'delete_post' qui appellera mon_premier_plugin_post_delete_mail()
add_action('delete_post', 'mon_premier_plugin_post_delete_mail');

//Fonction qui remplace la chaine 'et' par '&amp;'
function mon_premier_plugin_the_title( $title ) {
    //Remplace 'et' dans le titre
    $title = str_replace( 'et', '&amp;', $title );
    //Retourne le titre modifié
    return $title;
}
//Ajout d'un filtre sur 'the_title' qui appellera mon_premier_plugin_the_title()
add_filter( 'the_title', 'mon_premier_plugin_the_title' );

//Fonction de rappel qui retourne la célèbre citation de maître Yoda
function mon_premier_plugin_yoda_shortcode() {
    return "<blockquote>Que la force soit avec toi jeune padawan !</blockquote>";
}

//Enregistre les shortcodes du plugin
function mon_premier_plugin_register_shortcode() {
    add_shortcode( 'yoda', 'mon_premier_plugin_yoda_shortcode' );
}
add_action( 'init', 'mon_premier_plugin_register_shortcode' );

/**
 * Shortcode qui retourne le célèbre "Luke, Je sui ton père !" dans un élément blockquote.
 * Le contenu du shortcode sera utilisé pour remplacer 'Luke'
 *
 * Exemples :
 * [vador] => <blockquote>Luke, Je sui ton père !</blockquote>
 * [vador]Serge[/vador] => <blockquote>Serge, Je sui ton père !</blockquote>
 */

function mon_premier_plugin_vador_shortcode($atts, $content = "") {
    //Si contenu vide
    if (empty( $content )) {
        $content = 'Luke';
    }
    return "<blockquote>" . $content . ", Je suis ton père !</blockquote>";
}

//Fonction de rappel qui retourne la célèbre citation de maître Yoda
function mon_premier_plugin_yoda_shortcode() {
    return "<blockquote>Que la force soit avec toi jeune padawan !</blockquote>";
}

//Enregistre les shortcodes du plugin
function mon_premier_plugin_register_shortcode() {
    add_shortcode( 'yoda', 'mon_premier_plugin_yoda_shortcode' );
    add_shortcode( 'vador', 'mon_premier_plugin_vador_shortcode' );
}
add_action( 'init', 'mon_premier_plugin_register_shortcode' );