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

/* /var/www/sitefiles/themes/diia/pages/paymentStatus.htm */
class __TwigTemplate_cd50daba0c226968d3ec1427cfb7c287057daee437c1ea34426f84d513eb5af0 extends \Twig\Template
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
        echo "<style>
    .hidden {
        display: none;
    }
</style>
<body>
    <div class=\"not-found\">
\t\t<div class=\"container not-found_content\">
            <div class=\"row\">
                <div class=\"col-12\">
                    <a href=\"";
        // line 11
        echo KitSoft\Core\Twig\UrlFilter::url("/");
        echo "\" class=\"not-found_link\">
                        <div class=\"not-found_icon\">
                            <div class=\"not-found_icon-gerb\"></div>
                            <div class=\"not-found_icon-diya\"></div>
                        </div>
                    </a>
                </div>
                <div class=\"col-12\">
                    <div class=\"not-found_error\">
                        <div id=\"successMessage\" class=\"hidden\">
                            <div class=\"not-found_error-description\">";
        // line 21
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Вітаємо"]);
        echo "!</div>
                            <div class=\"not-found_error-proposition\">";
        // line 22
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Оплата послуги пройшла успішно"]);
        echo "</div>
                        </div>
                        <div id=\"failsMessage\" class=\"hidden\">
                            <div class=\"not-found_error-description\">";
        // line 25
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Увага"]);
        echo "!</div>
                            <div class=\"not-found_error-proposition\">";
        // line 26
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Не вдалось здійснити оплату послуги"]);
        echo "</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=\"overlay-full-screen\"></div>
</body>

<script>
    const findParam = window.location.search;
    const params = findParam.split('&');
    for (let i = 0; i < params.length; i++) {
        const paramKey = params[i].split('=')[0];
        const paramVal = params[i].split('=')[1];
        if(paramKey === 'status' || paramKey === '?status')  {
            paramVal === 'true' && document.getElementById('successMessage').classList.remove('hidden');
            paramVal !== 'true' && document.getElementById('failsMessage').classList.remove('hidden');
        }
    }
</script>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/paymentStatus.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 26,  72 => 25,  66 => 22,  62 => 21,  49 => 11,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/paymentStatus.htm", "");
    }
}
