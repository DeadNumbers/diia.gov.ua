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

/* /var/www/sitefiles/themes/diia/pages/service.htm */
class __TwigTemplate_fd0173a49b51dc0d951f45fd7b0eb93ae97d364994018d876417b40248c93bcb extends \Twig\Template
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
        $context["service"] = twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "service", [], "any", false, false, false, 1);
        // line 2
        echo "
<section class=\"service-type_wrap\">
\t<div class=\"container\">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-6\">
\t\t\t\t<a href=\"/\" class=\"service-type_link back\">";
        // line 7
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["На головну"]);
        echo "</a>
\t\t\t</div>
\t\t\t";
        // line 9
        if (twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "isPrintable", [], "any", false, false, false, 9)) {
            // line 10
            echo "\t\t\t\t<div class=\"col-6\">
\t\t\t\t\t<div class=\"service-type_link-box\">
\t\t\t\t\t\t<a href=\"";
            // line 12
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "full_url", [], "any", false, false, false, 12), "html", null, true);
            echo "?pdf\" target=\"_blank\" rel=\"noopener noreferrer\" data-url=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "full_url", [], "any", false, false, false, 12), "html", null, true);
            echo "?pdf\" class=\"service-type_link print\" id=\"print-instruction\"> <span>";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Роздрукувати інструкцію"]);
            echo "</span></a>
\t\t\t\t\t\t<!-- Button trigger modal -->
\t\t\t\t\t\t<a href=\"javascript:void(0)\" class=\"service-type_link email\" data-toggle=\"modal\" data-target=\"#exampleModal\"><span>";
            // line 14
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Відправити на email "]);
            echo "</span></a>
\t\t\t\t\t\t<!-- END Button trigger modal -->
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t";
        }
        // line 19
        echo "\t\t\t<div class=\"col-12\">
\t\t\t\t";
        // line 20
        if (twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "title", [], "any", false, false, false, 20)) {
            // line 21
            echo "\t\t\t\t\t<div class=\"service-type_title\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "title", [], "any", false, false, false, 21), "html", null, true);
            echo "</div>
\t\t\t\t";
        }
        // line 23
        echo "\t\t\t\t";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "fields", [], "any", false, false, false, 23), "link", [], "any", false, false, false, 23)) {
            // line 24
            echo "\t\t\t\t\t<div class=\"text-center\">
\t\t\t\t\t\t<a ";
            // line 25
            if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "fields", [], "any", false, false, false, 25), "link_modal", [], "any", false, false, false, 25)) {
                echo "href=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "fields", [], "any", false, false, false, 25), "link", [], "any", false, false, false, 25), "html", null, true);
                echo "\"";
            } else {
                echo "href=\"javascript:void(0)\"";
            }
            echo " ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "fields", [], "any", false, false, false, 25), "target", [], "any", false, false, false, 25)) {
                echo "target=\"_blank\"";
            }
            echo " class=\"btn btn-fill mt-0\" ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "fields", [], "any", false, false, false, 25), "link_modal", [], "any", false, false, false, 25)) {
                echo "data-toggle=\"modal\" data-target=\"#exampleModalRedirect\"";
            }
            echo ">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "fields", [], "any", false, false, false, 25), "link_label", [], "any", false, false, false, 25), "html", null, true);
            echo "</a>
\t\t\t\t\t</div>
\t\t\t\t\t";
            // line 27
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "fields", [], "any", false, false, false, 27), "link_description", [], "any", false, false, false, 27)) {
                // line 28
                echo "\t\t\t\t       \t<div class=\"service-type_login-text\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "fields", [], "any", false, false, false, 28), "link_description", [], "any", false, false, false, 28), "html", null, true);
                echo "</div>
\t\t\t\t    ";
            }
            // line 30
            echo "\t\t\t\t";
        }
        // line 31
        echo "\t\t\t</div>
\t\t</div>
\t</div>
\t<!-- Modal -->
\t<div class=\"modal modal-service fade\" id=\"exampleModal\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
\t\t<div class=\"modal-dialog modal-service_dialog\" role=\"document\">
\t\t    <div class=\"modal-content modal-service_content\">
\t\t\t\t<div class=\"modal-service_close icn_modal-close-service\" data-dismiss=\"modal\" aria-label=\"Close\"></div>
\t\t\t    <div class=\"modal-service_body\">
\t\t\t    \t<div class=\"modal-service_title\">
\t\t\t    \t\t";
        // line 41
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Відправити інструкцію на email"]);
        echo "
\t\t\t    \t</div>
\t\t\t    \t<form class=\"form form-service\" accept-charset=\"utf-8\" id=\"modal-send-email\">
                        <div class=\"input-border-gradient\">
                            <input type=\"email\" name=\"email\" class=\"input form-service_input\" placeholder=\"Твій email\">
                            <div class=\"border-gradient\"></div>
                        </div>
\t\t\t    \t\t<button ";
        // line 48
        echo " class=\"btn btn-fill\" id=\"modal-send-email-btn\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Відправити інструкцію"]);
        echo "</button>
\t\t\t    \t</form>
\t\t\t    </div>
                <div class=\"modal-service_done\">
                    <div class=\"modal-service_done-icn\"></div>
                    <div class=\"modal-service_done-title\">";
        // line 53
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Інструкція відправлена на пошту"]);
        echo "</div>
                    <div class=\"modal-service_done-text\">";
        // line 54
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "form", [], "any", false, false, false, 54), "success_text", [], "any", false, false, false, 54);
        echo "</div>
                    <div class=\"modal-service_done-btn\">
                        <a href=\"/\" class=\"btn btn_default\"><span>";
        // line 56
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["На головну"]);
        echo "</span></a>
                    </div>
                </div>
\t\t    </div>
\t\t</div>
\t</div>
\t<!-- Modal -->
\t<!-- Modal -->
\t";
        // line 64
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "fields", [], "any", false, false, false, 64), "link_modal", [], "any", false, false, false, 64)) {
            // line 65
            echo "\t\t<div class=\"modal modal-service fade\" id=\"exampleModalRedirect\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
\t\t\t<div class=\"modal-dialog modal-service_dialog\" role=\"document\">
\t\t\t    <div class=\"modal-content modal-service_content\">
\t\t\t\t\t<div class=\"modal-service_close icn_modal-close-service\" data-dismiss=\"modal\" aria-label=\"Close\"></div>
\t                <div class=\"modal-service_warn\">
\t                    <div class=\"modal-service_warn-icn\"></div>
\t                    <div class=\"modal-service_warn-title\">";
            // line 71
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Увага"]);
            echo "</div>
\t                    <div class=\"modal-service_warn-text\">";
            // line 72
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "fields", [], "any", false, false, false, 72), "link_modal_text", [], "any", false, false, false, 72), "html", null, true);
            echo "</div>
\t                    <div class=\"modal-service_warn-btn\">

\t                        <a href=\"";
            // line 75
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "fields", [], "any", false, false, false, 75), "link", [], "any", false, false, false, 75), "html", null, true);
            echo "\" class=\"btn btn_default\" ";
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "fields", [], "any", false, false, false, 75), "target", [], "any", false, false, false, 75)) {
                echo "target=\"_blank\"";
            }
            echo "><span>";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Продовжити"]);
            echo "</span></a>
\t                    </div>
\t                </div>
\t\t\t    </div>
\t\t\t</div>
\t\t</div>
\t";
        }
        // line 82
        echo "\t<!-- Modal -->
</section>

";
        // line 85
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["service"] ?? null), "raw_sections", [], "any", false, false, false, 85));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 86
            echo "    ";
            $context['__cms_partial_params'] = [];
            $context['__cms_partial_params']['data'] = twig_get_attribute($this->env, $this->source, $context["item"], "fields", [], "any", false, false, false, 86)            ;
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction(("site/sections/" . twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 86))            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 88
        echo "
";
        // line 89
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 90
        echo "\t<script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/validate-1.19.1/jquery.validate.min.js");
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 91
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/javascript/build/serviceitem.bundle.js");
        echo "\"></script>
";
        // line 89
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/service.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  243 => 89,  239 => 91,  234 => 90,  232 => 89,  229 => 88,  219 => 86,  215 => 85,  210 => 82,  194 => 75,  188 => 72,  184 => 71,  176 => 65,  174 => 64,  163 => 56,  158 => 54,  154 => 53,  145 => 48,  135 => 41,  123 => 31,  120 => 30,  114 => 28,  112 => 27,  91 => 25,  88 => 24,  85 => 23,  79 => 21,  77 => 20,  74 => 19,  66 => 14,  57 => 12,  53 => 10,  51 => 9,  46 => 7,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/service.htm", "");
    }
}
