<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" 
xmlns:soap="http://www.w3.org/2003/05/soap-envelope" 
xmlns:ws="http://www.mnb.hu/webservices/"
exclude-result-prefixes="ws">

<xsl:output method="text" indent="yes" version="1.0" encoding="UTF-8" />
<xsl:strip-space elements="*"/>

<xsl:template match="/">
  <xsl:apply-templates/>
</xsl:template>

<xsl:template match="RtaBuscarArchivo">
    <xsl:for-each select="Archivo">
    <xsl:variable name="nombreArchivo">
        <xsl:value-of select="Nombre"/>
    </xsl:variable>
    <xsl:variable name="nombreArchivoT">
        <xsl:value-of select="translate($nombreArchivo,'áàâäéèêëíìîïóòôöúùûü°¨`','aaaaeeeeiiiioooouuuu   ')" />
    </xsl:variable>
    INSERT INTO archivos VALUES(<xsl:value-of select="Id" />,"<xsl:value-of select="translate($nombreArchivoT,'&quot;','')" />");
    INSERT INTO tipo_archivo VALUES(NULL,"<xsl:call-template name="get-file-extension">
        <xsl:with-param name="path" select="$nombreArchivo" />
    </xsl:call-template>",<xsl:value-of select="Id"/>);
    </xsl:for-each>
</xsl:template>

<xsl:template name="get-file-extension">
    <xsl:param name="path"/>
    <xsl:choose>
        <xsl:when test="contains($path, '.')">
            <xsl:call-template name="get-file-extension">
                <xsl:with-param name="path" select="substring-after($path, '.')"/>
            </xsl:call-template>
        </xsl:when>
        <xsl:otherwise>
            <xsl:value-of select="$path"/>
        </xsl:otherwise>
    </xsl:choose>
</xsl:template>

</xsl:stylesheet>