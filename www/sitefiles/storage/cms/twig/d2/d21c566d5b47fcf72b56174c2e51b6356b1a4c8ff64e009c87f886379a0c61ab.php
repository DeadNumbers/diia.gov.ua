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

/* /var/www/sitefiles/themes/diia/pages/taxSystem.htm */
class __TwigTemplate_639e2a8c76cedb3550eaa122378b98858a8dda2cd6f2a76deabdbee9d6b42977 extends \Twig\Template
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
        $context["isRefererFromTest"] = get("choise");
        // line 2
        echo "<section class=\"test-fop_wrap\">
    <div class=\"test-fop_container\">
        <div class=\"test-fop_result\">
            <div class=\"test-fop_head\">
                <div class=\"col-6 pl-0\">
                    <div class=\"test-fop_head-logo-big\">
                        <a href=\"/\">
                            <div class=\"icn-logo_gerb-b\"></div>
                            <div class=\"icn-logo_diia-b\"></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class=\"test-fop_content-title\">
                ";
        // line 16
        if (($context["isRefererFromTest"] ?? null)) {
            echo "<span class=\"test-fop_content-title-icn\"></span>";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Вам підходить"]);
        }
        echo " ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["taxSystem"] ?? null), "item", [], "any", false, false, false, 16), "title", [], "any", false, false, false, 16), "html", null, true);
        echo "
            </div>
            <div class=\"test-fop_content-print\">
                <div class=\"service-type_link-box\">
                    <a href=\"";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["taxSystem"] ?? null), "full_url", [], "any", false, false, false, 20), "html", null, true);
        echo "?pdf\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"service-type_link print\"><span>";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Роздрукувати"]);
        echo "</span></a>
                    <a href=\"javascript:void(0)\" class=\"service-type_link email\" data-toggle=\"modal\" data-target=\"#exampleModal\"><span>";
        // line 21
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Відправити на email "]);
        echo "</span></a>
                </div>
            </div>
            <div class=\"test-fop_content-res\">
                ";
        // line 25
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["taxSystem"] ?? null), "item", [], "any", false, false, false, 25), "fields", [], "any", false, false, false, 25), "info", [], "any", false, false, false, 25), "title", [], "any", false, false, false, 25)) {
            // line 26
            echo "                <div class=\"h5\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["taxSystem"] ?? null), "item", [], "any", false, false, false, 26), "fields", [], "any", false, false, false, 26), "info", [], "any", false, false, false, 26), "title", [], "any", false, false, false, 26), "html", null, true);
            echo "</div>
                <div class=\"test-fop_result-info\">
                    <div class=\"test-fop_result-bg\">
                        ";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["taxSystem"] ?? null), "item", [], "any", false, false, false, 29), "fields", [], "any", false, false, false, 29), "info", [], "any", false, false, false, 29), "items", [], "any", false, false, false, 29));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 30
                echo "                        <div class=\"test-fop_result-info-item\">
                            <div class=\"test-fop_result-info-title\">";
                // line 31
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 31), "html", null, true);
                echo "</div>
                            <div class=\"test-fop_result-info-sub\">";
                // line 32
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 32), "html", null, true);
                echo "</div>
                        </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "                    </div>
                </div>
                ";
        }
        // line 38
        echo "                ";
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["taxSystem"] ?? null), "item", [], "any", false, false, false, 38), "content", [], "any", false, false, false, 38))) {
            // line 39
            echo "                <div class=\"editor-content editor-content_test-fop\">
                    ";
            // line 40
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["taxSystem"] ?? null), "item", [], "any", false, false, false, 40), "content", [], "any", false, false, false, 40);
            echo "
                </div>
                ";
        }
        // line 43
        echo "                ";
        if (($context["isRefererFromTest"] ?? null)) {
            // line 44
            echo "                <a href=\"";
            echo url("/");
            echo "\" class=\"btn btn-fill btn-fill-sm btn-start\">";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Дякую"]);
            echo "</a>
                ";
        }
        // line 46
        echo "            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class=\"modal modal-service fade\" id=\"exampleModal\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-service_dialog\" role=\"document\">
        <div class=\"modal-content modal-service_content\">
            <div class=\"modal-service_close icn_modal-close-service\" data-dismiss=\"modal\" aria-label=\"Close\"></div>
            <div class=\"modal-service_body\">
                <div class=\"modal-service_title\">
                    ";
        // line 57
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Відправити результат на email"]);
        echo "
                </div>
                <form class=\"form form-service\" accept-charset=\"utf-8\" id=\"modal-send-email\">
                    <div class=\"input-border-gradient\">
                        <input type=\"email\" name=\"email\" class=\"input form-service_input\" placeholder=\"Твій email\">
                        <div class=\"border-gradient\"></div>
                    </div>
                    <button ";
        // line 64
        echo " class=\"btn btn-fill\" id=\"modal-send-email-btn\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Відправити результат"]);
        echo "</button>
                </form>
            </div>
            <div class=\"modal-service_done\">
                <div class=\"modal-service_done-icn\"></div>
                <div class=\"modal-service_done-title\">";
        // line 69
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Результат відправлений на пошту"]);
        echo "</div>
                <div class=\"modal-service_done-text\">";
        // line 70
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "form", [], "any", false, false, false, 70), "success_text", [], "any", false, false, false, 70);
        echo "</div>
                <div class=\"modal-service_done-btn\">
                    <a href=\"/\" class=\"btn btn_default\"><span>На головну</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
";
        // line 79
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 80
        echo "<script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/validate-1.19.1/jquery.validate.min.js");
        echo "\"></script>
<script type=\"text/javascript\" src=\"";
        // line 81
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/testFop.bundle.js"]);
        echo "\"></script>
";
        // line 79
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/taxSystem.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  196 => 79,  192 => 81,  187 => 80,  185 => 79,  173 => 70,  169 => 69,  160 => 64,  150 => 57,  137 => 46,  129 => 44,  126 => 43,  120 => 40,  117 => 39,  114 => 38,  109 => 35,  100 => 32,  96 => 31,  93 => 30,  89 => 29,  82 => 26,  80 => 25,  73 => 21,  67 => 20,  55 => 16,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/taxSystem.htm", "");
    }
}
