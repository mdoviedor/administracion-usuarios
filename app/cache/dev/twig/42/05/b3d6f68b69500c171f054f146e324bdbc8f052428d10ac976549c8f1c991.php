<?php

/* AseduisFrontalBundle:Index:index.html.twig */
class __TwigTemplate_4205b3d6f68b69500c171f054f146e324bdbc8f052428d10ac976549c8f1c991 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::index.html.twig");

        $this->blocks = array(
            'contenido' => array($this, 'block_contenido'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::index.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_contenido($context, array $blocks = array())
    {
        // line 3
        echo "<h3>Iniciar Sesión</h3>
";
        // line 4
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 5
            echo "<div id=\"login-error\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "message")), "html", null, true);
            echo "</div>
";
        }
        // line 7
        echo "<form action=\"";
        echo $this->env->getExtension('routing')->getPath("login_check");
        echo "\" method=\"post\">
    <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 8
        echo $this->env->getExtension('actions')->renderUri($this->env->getExtension('http_kernel')->controller("AseduisUserBundle:Security:getToken"), array());
        echo "\" />

    <label for=\"username\">Usuario</label><br>
    <input id=\"username\" type=\"text\" name=\"_username\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
        echo "\" />  <br>

    <label for=\"password\">Contraseña</label><br>
    <input id=\"password\" type=\"password\" name=\"_password\" /><br><br>

    <input type=\"submit\" name=\"login\" value=\"Iniciar sesión\" />  

</form>
";
    }

    public function getTemplateName()
    {
        return "AseduisFrontalBundle:Index:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 11,  47 => 8,  42 => 7,  36 => 5,  34 => 4,  31 => 3,  28 => 2,);
    }
}
