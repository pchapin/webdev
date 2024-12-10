
class ColorChart {

    private final static String lookupTable = "0123456789ABCDEF";

    public static void main(String[] argv)
    {
        System.out.println("<html>");
        System.out.println("<head>");
        System.out.println("<title>Color Chart</title>");
        System.out.println("<style type=\"text/css\">");
        System.out.println("td { width: 50; height: 25; }");
        System.out.println("table { font-family: monospace; }");
        System.out.println("</style>");
        System.out.println("</head>");
        System.out.println("<body>");
        System.out.println("<h1>Color Chart</h1>");
        for (int i = 0; i < 16; i++) {
            System.out.println("<hr>");
            System.out.println(
              "<h2>Red Level " + lookupTable.charAt(i) + "</h2>");
            System.out.println("<table border=\"1\">");
            for (int j = 0; j < 16; j++) {
                System.out.print("<tr>");
                for (int k = 0; k < 16; k++) {
                    char[] rawColor = new char[4];
                    rawColor[0] = '#';
                    rawColor[1] = lookupTable.charAt(i);
                    rawColor[2] = lookupTable.charAt(j);
                    rawColor[3] = lookupTable.charAt(k);
                    String color = new String(rawColor);
                    String constrastingColor;
                    if (2*i + 2*j + k >= 60 || j >= 12)
                        constrastingColor = new String("gray");
                    else
                        constrastingColor = new String("white");
                    System.out.print(
                       "<td style=\"background: " + constrastingColor + ";"   +
                                   "color: "      + color + "\">" +
                                     color + "</td>");
                }
                System.out.print("</tr>\n");
            }
            System.out.println("</table>");
        }
        System.out.println("</body>");
        System.out.println("</html>");
    }
}
