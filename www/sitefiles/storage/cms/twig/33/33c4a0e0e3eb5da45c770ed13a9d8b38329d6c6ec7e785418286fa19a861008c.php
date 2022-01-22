<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /var/www/sitefiles/themes/diia/partials/poll/answer.htm */
class __TwigTemplate_8f313e360deadfad04a039b14e13c874d9d358ee4e526a52158955c45bff0ff5 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"finish-box\">
    <div class=\"finish-logo\">
        <a href=\"/\">
            <div class=\"icn-logo_gerb-b\"></div>
            <div class=\"icn-logo_diia-b\"></div>
        </a>
    </div>
    <div class=\"article-level-2 text-center\">
        ";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "option", [], "any", false, false, false, 9), "answer", [], "any", false, false, false, 9), "title", [], "any", false, false, false, 9), "html", null, true);
        echo "
    </div>
    <div class=\"finish-content\">
        ";
        // line 12
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "option", [], "any", false, false, false, 12), "answer", [], "any", false, false, false, 12), "text", [], "any", false, false, false, 12);
        echo "
    </div>
</div>
<script>
setTimeout(function() {
    var container = document.getElementById('poll-form-step');
    container.scrollIntoView({ 
    \tbehavior: 'smooth',
    \tblock: 'center' 
    });
}, 4);

</script>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/poll/answer.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 12,  47 => 9,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/poll/answer.htm", "");
    }
}
