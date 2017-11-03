<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

	<xsl:param name="hamningsberg_vaer" select="document('hamningsberg_vaer.xml')"/>
    <xsl:param name="steilnesset_vaer" select="document('steilnesset_vaer.xml')"/>
    <xsl:param name="nesseby_vaer" select="document('nesseby_vaer.xml')"/>
    <xsl:param name="gornitak_vaer" select="document('gornitak_vaer.xml')"/>

    <xsl:output method="xml" indent="yes"/>

    <xsl:template match="turistveg-attraksjon">

       <xsl:value-of select="title"/>
        <xsl:value-of select="description_no"/>

        <xsl:choose>
        <xsl:when test="title = $hamningsberg_vaer//weatherdata/location/name">
        <xsl:apply-templates select="$hamningsberg_vaer//weatherdata/forecast/text/location/time[1]/body"/>
        </xsl:when>
            <xsl:when test="title = $steilnesset_vaer//weatherdata/location/name">
            <xsl:apply-templates select="$steilnesset_vaer//weatherdata/forecast/text/location/time[1]/body"/>
            </xsl:when>
            <xsl:when test="title = $nesseby_vaer//weatherdata/location/name">
            <xsl:apply-templates select="$nesseby_vaer//weatherdata/forecast/text/location/time[1]/body"/>
            </xsl:when>
            <xsl:when test="title = $gornitak_vaer//weatherdata/location/name">
            <xsl:apply-templates select="$gornitak_vaer//weatherdata/forecast/text/location/time[1]/body"/>
            </xsl:when>

        </xsl:choose>
    </xsl:template>

    <xsl:template match="@* | node()">
        <xsl:copy>
            <xsl:apply-templates select="@* | node()"/>
        </xsl:copy>
    </xsl:template>



</xsl:stylesheet>