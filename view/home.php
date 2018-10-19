<!DOCTYPE html>
<html lang="pt" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Hacker Gaucho</title>
    <link rel="stylesheet" href="/style.css?t=<?php print time();?>">
</head>
<body>

    <button onclick="irParaOTopo()" id="btnIrParaOTopo" title="Go to top">Topo</button>
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
                <button class="block" type="button" onclick="javascript:linksPrevious();">
                    Ver links anteriores
                </button>
            </td>
            <td width="50%">
                <button class="block" type="button" onclick="javascript:linksNext();">
                    Ver links mais recentes
                </button>
            </td>
        </tr>
    </table>
    <script src="/jquery-1.11.1.min.js"></script>
    <script src="/script.js"></script>
</body>
</html>
