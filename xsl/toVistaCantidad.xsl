<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <xsl:apply-templates/>
</xsl:template>

<xsl:template match="RtaBuscarArchivo">
<section class="welcome p-t-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h2 class="title-4">Cantidad Archivos Cargados
                <span>Analitica</span>
            </h2>
            <a href='index.php?ruta=archivos'>Volver</a>
            <table class="table">
                <tr>
                <th style="text-align:left">Extension</th>
                <th style="text-align:left">Cantidad</th>
                </tr>
                <xsl:for-each select="Archivo">
                <tr>
                <td><xsl:value-of select="extension" /></td>
                <td><xsl:value-of select="cantidad" /></td>
                </tr>
                </xsl:for-each>
            </table>
            </div>
        </div>
    </div>
</section>
</xsl:template>

</xsl:stylesheet>