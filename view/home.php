<!DOCTYPE html>
<html lang="pt" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Hacker Gaucho</title>
    <style>
    *{
        border:0;
        padding:0;
    }
    .block, label{
        display:block;
        width:100%;
    }
    .input-text,button{
        background-color:#f6f6f6;
        border:1px solid gray;
        padding:1em;
    }
    .input-text.block,button{
        width:calc(100% - 2em - 2px);
    }
    button.block,label{
        cursor:pointer;
    }
    ol,ul{
        margin-left:2em;
    }
    table{
        border-collapse: collapse;
        margin:0 auto;
        width:100%;
    }
    td{
        vertical-align: top;
    }
    @media all and (max-width: 799px) {
        h1{
            text-align:center;
        }
        td {
            display:inline-block;
            width: 100%;
        }
    }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td>
                <h1>Hacker Brasil</h1>
            </td>
            <td>
                <form>
                    <label form="s">Buscar pelo título da notícias</label>
                    <input type="text" name="s" class="block input-text" id="s">
                </form>
            </td>
        </tr>
        <tr>
            <td width="50%">
                <button class="block" type="button" onclick="javascript:linksPrevious();">Enviar feed</button>
            </td>
            <td width="50%">
                <button class="block" type="button" onclick="javascript:linksNext();">Mais clicados do dia</button>
            </td>
        </tr>
    </table>
    <p><span id="numeroDeLinks"></span>&nbsp;links no total</p>
    <ol id="links">
    </ol>
    <table width="100%">
        <tr>
            <td width="50%">
                <button class="block" type="button" onclick="javascript:linksPrevious();">Página anterior</button>
            </td>
            <td width="50%">
                <button class="block" type="button" onclick="javascript:linksNext();">Próxima página</button>
            </td>
        </tr>
    </table>
    <script src="/jquery-1.2.min.js"></script>
    <script src="/js.cookie.min.js"></script>
    <script src="/script.js?time=<?php print time();?>"></script>
</body>
</html>
