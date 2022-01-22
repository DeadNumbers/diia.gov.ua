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

/* /var/www/sitefiles/themes/diia/partials/site/chatbot.htm */
class __TwigTemplate_e94cc6fb0c5294f71bdbf5c82d2068aba41948b5eed1605866e5460d65499d92 extends \Twig\Template
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
        echo "<div class=\"chatbot\">
    <div class=\"chatbot_content\" id=\"chatbot_content\">
        <div class=\"chatbot_list\">
            <a href=\"https://t.me/Diia_help_bot?start=X3VybD0lMkZsaW5rJmQ9Mg\" class=\"chatbot_item\" rel=\"noopener noreferrer\" target=\"_blank\">
                <div class=\"chatbot_item-icn icn-chatbot_tl\"></div>
                <div class=\"chatbot_item-text\" >Telegram</div>
            </a>
            <a href=\"viber://pa?chatURI=diia_help_bot&context=X3VybD0lMkZsaW5rJmQ9Mg==\" class=\"chatbot_item\" rel=\"noopener noreferrer\" target=\"_blank\">
                <div class=\"chatbot_item-icn icn-chatbot_vb\"></div>
                <div class=\"chatbot_item-text\" >Viber</div>
            </a>
            <a href=\"https://m.me/105597857511240?ref=X3VybD0lMkZsaW5rJmQ9Mg==\" class=\"chatbot_item\" rel=\"noopener noreferrer\" target=\"_blank\">
                <div class=\"chatbot_item-icn icn-chatbot_fb\"></div>
                <div class=\"chatbot_item-text\">Messenger</div>
            </a>
        </div>
    </div>
    <div class=\"chatbot_btn\" id=\"chatbot_btn\" title=\"Чат бот\"></div>
</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/chatbot.htm";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/chatbot.htm", "");
    }
}
