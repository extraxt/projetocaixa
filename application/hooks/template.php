<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); // Essa linha é obrigatória pra segurança do arquivo.

class Template {

     public function init() {
          
          $CI = &get_instance();
          $output = $CI->output->get_output();
          $erroDashboard = null;
          $sucessoDashboard = null;

          if (isset($CI->layout)) {
               if ($CI->layout) {

                    // SISTEMA DE MENSAGEM DE AVISO SUPERIOR PARTE 1
                    if($CI->layout == "dashboard"){
                         $erroDashboard    = $CI->session->flashdata("erro");
                         $sucessoDashboard = $CI->session->flashdata("sucesso");
                    }
                    if($CI->layout == "login"){
                         $erroDashboard    = $CI->session->flashdata("erro");
                         $sucessoDashboard = $CI->session->flashdata("sucesso");
                    }
                    if($CI->layout == "lancamentos_dashboard"){
                         $erroDashboard    = $CI->session->flashdata("erro");
                         $sucessoDashboard = $CI->session->flashdata("sucesso");
                    }
                    /// FIM PARTE 1


                    if (!preg_match('/(.+).php$/', $CI->layout)) {
                         $CI->layout .= '.php';
                    }
                    $template = APPPATH . 'templates/'.$CI->layout;

                    if (file_exists($template)){ 
                         $layout = $CI->load->file($template, TRUE);
                    } else {
                         die('Template inválida.');
                    }

                    $html = str_replace("{CONTEUDO}", $output, $layout);

                    // SISTEMA DE MENSAGEM DE AVISO SUPERIOR PARTE 2
                    if($erroDashboard){
                         $erroDashboard = $this->estilizaAlerta($erroDashboard, "alert-danger", "Ops!");
                         $html = str_replace("{MSG_ERRO}", $erroDashboard, $html);
                    } else {
                         $html = str_replace("{MSG_ERRO}", null, $html);
                    }

                    if($sucessoDashboard){
                         $sucessoDashboard = $this->estilizaAlerta($sucessoDashboard, "alert-success", "Parabéns!");
                         $html = str_replace("{MSG_SUCESSO}", $sucessoDashboard, $html);
                    } else {
                         $html = str_replace("{MSG_SUCESSO}", null, $html);
                    } /// FIM PARTE 2

               } else {
               $html = $output;
               }
          } else {
               $html = $output; 
          }
          
          $CI->output->_display($html);
     }

     private function estilizaAlerta($mensagem, $tipo_do_alerta, $titulo_do_alerta){
          $html = "<br>";
          $html.= "<div class=\" container alert {$tipo_do_alerta}\">\n";
          $html.= "\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>\n";
          $html.= "\t<strong>{$titulo_do_alerta}</strong> {$mensagem}\n";
          $html.= "</div>";
          return $html;
     }
}
