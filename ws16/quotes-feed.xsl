<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns="http://www.w3.org/1999/xhtml">

  <xsl:output method="html" indent="yes"/>
  <xsl:template match="/">
    <html>
      <head>
        <title>Quotes Feed</title>
        <style type="text/css">
          body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
          }
          .quote-item {
            background: #fff;
            margin: 10px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
          }
          .quote-item img {
            max-width: 100px;
            max-height: 100px;
            float: left;
            margin-right: 20px;
          }
          .quote-text {
            font-size: 16px;
            margin: 0;
          }
          .quote-author {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
          }
        </style>
      </head>
      <body>
        <xsl:for-each select="rss/channel/item">
          <div class="quote-item">
            <img>
              <xsl:attribute name="src">
                <xsl:value-of select="description/img/@src"/>
              </xsl:attribute>
            </img>
            <p class="quote-text">
              <xsl:value-of select="title"/>
            </p>
            <p class="quote-author">
              <xsl:value-of select="link"/>
            </p>
          </div>
        </xsl:for-each>
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>
