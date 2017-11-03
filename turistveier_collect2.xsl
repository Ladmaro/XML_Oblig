<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:transform version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="xml" version="1.0" indent="yes" />
    <xsl:variable name="nesseby_vaer" select="'nesseby_vaer.xml'" />

    <xsl:template match="@*|node()">
        <xsl:copy>
            <xsl:apply-templates select="@*|node()" />
        </xsl:copy>
    </xsl:template>

    <xsl:template match="weatherdata">
        <xsl:copy>
            <xsl:apply-templates select="@*|node()" />
            <xsl:variable name="info" select="document($nesseby_vaer)/weatherdata/location[name=current()/name]/." />
            <xsl:for-each select="$info/*">
                <xsl:if test="name()!='name'">
                    <xsl:copy-of select="document($nesseby_vaer)/weatherdata/forecast/text/location/time[1]/body" />
                </xsl:if>
            </xsl:for-each>
        </xsl:copy>
    </xsl:template>
</xsl:transform>