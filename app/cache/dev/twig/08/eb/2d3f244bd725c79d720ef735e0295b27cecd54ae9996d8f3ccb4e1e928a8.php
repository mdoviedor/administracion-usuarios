<?php

/* ::index.html.twig */
class __TwigTemplate_08eb2d3f244bd725c79d720ef735e0295b27cecd54ae9996d8f3ccb4e1e928a8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::base.html.twig");

        $this->blocks = array(
            'menu' => array($this, 'block_menu'),
            'body' => array($this, 'block_body'),
            'titulo' => array($this, 'block_titulo'),
            'submenuizquierdo' => array($this, 'block_submenuizquierdo'),
            'submenuderecho' => array($this, 'block_submenuderecho'),
            'contenido' => array($this, 'block_contenido'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_menu($context, array $blocks = array())
    {
        // line 3
        echo "<nav class=\"navbar navbar-default navbar-fixed-top\" role=\"navigation\">
    <div class=\"container\">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class=\"navbar-header\">
            <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">
                <span class=\"sr-only\">Toggle navigation</span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
            <a class=\"navbar-brand\" href=\"#\">ASEDUIS</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
            <ul class=\"nav navbar-nav\">
            </ul>

            <ul class=\"nav navbar-nav navbar-right\">              
                <li class=\"active\"><a href=\"#\">Registrarse</a></li>                                
                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Opciones<b class=\"caret\"></b></a>
                    <ul class=\"dropdown-menu\">
                        <li><a href=\"#\">Ayuda</a></li>                         
                        <li class=\"divider\"></li>
                        <li><a href=\"#\">Contactenos</a></li>                                         
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
";
    }

    // line 37
    public function block_body($context, array $blocks = array())
    {
        // line 38
        echo "<br><br>

<div class=\"container\">

    <div class=\"page-header\">
";
        // line 43
        $this->displayBlock('titulo', $context, $blocks);
        // line 45
        echo "    </div>
    <div class=\"row\">
        <div class=\"col-xs-6 col-md-4\" style=\"border-color: #000;\">
            ";
        // line 48
        $this->displayBlock('submenuizquierdo', $context, $blocks);
        // line 50
        echo "        </div>
        <div class=\"col-xs-12 col-sm-6 col-md-8\" style=\"text-align: right;\">
             ";
        // line 52
        $this->displayBlock('submenuderecho', $context, $blocks);
        // line 54
        echo "        </div>
    </div>

";
        // line 57
        $this->displayBlock('contenido', $context, $blocks);
        // line 59
        echo "</div>

";
    }

    // line 43
    public function block_titulo($context, array $blocks = array())
    {
    }

    // line 48
    public function block_submenuizquierdo($context, array $blocks = array())
    {
        // line 49
        echo "            ";
    }

    // line 52
    public function block_submenuderecho($context, array $blocks = array())
    {
        // line 53
        echo "            ";
    }

    // line 57
    public function block_contenido($context, array $blocks = array())
    {
    }

    // line 62
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 62,  130 => 57,  126 => 53,  123 => 52,  119 => 49,  116 => 48,  111 => 43,  105 => 59,  103 => 57,  98 => 54,  96 => 52,  92 => 50,  90 => 48,  85 => 45,  83 => 43,  76 => 38,  73 => 37,  37 => 3,  34 => 2,);
    }
}
