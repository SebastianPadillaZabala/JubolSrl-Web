public String getQR(int pedido_id, int usuario_id, String nit) {
        try {
            java.sql.Statement consulta;
            ResultSet resultado = null;
            String query = "";
            query = "SELECT id, fecha, hora, monto_total FROM pedidos WHERE id = " + pedido_id;
            Connection con = conexion.connect();
            consulta = con.createStatement();
            resultado = consulta.executeQuery(query);
            ResultSetMetaData rsmd = resultado.getMetaData();
            while (resultado.next()) {
                this.id = resultado.getInt(1);
                this.fecha = resultado.getString(2);
                this.hora = resultado.getString(3);
                this.monto_total = resultado.getFloat(4);
            }
            consulta.close();
            con.close();
            String qr = "http://tecno-web-254210f85ec2.herokuapp.com/pago_facil/pagar/" +
                    usuario_id + "/" + pedido_id + "/" + nit;
            // String qr = "http://galba.test/pago_facil/pagar/" + usuario_id + "/" +
            // pedido_id
            // + "/" + nit;
            String response = "<h1>Gracias por su compra</h1>\n" + "<h2>Detalle del pedido</h2>\n" + "ID: " + this.id
                    + ".<br>"
                    + "Fecha: " + this.fecha + ".<br>" + "Hora: " + this.hora + ".<br>" + "Monto Total: "
                    + this.monto_total + " Bs. <br>" + "<h2>Lista de productos</h2>\n"
                    + "<table style=\"border-collapse: collapse; width: 100%; border: 1px solid black;\">\n" + "\n"
                    + "  <tr>\n" + "\n"
                    + "    <th style = \"text-align: left; padding: 8px; background-color: #3c4f76; color: white; border: 1px solid black;\">ID</th>\n"
                    + "\n"
                    + "    <th style = \"text-align: left; padding: 8px; background-color: #3c4f76; color: white; border: 1px solid black;\">IMAGEN</th>\n"
                    + "\n"
                    + "    <th style = \"text-align: left; padding: 8px; background-color: #3c4f76; color: white; border: 1px solid black;\">NOMBRE</th>\n"
                    + "\n"
                    + "    <th style = \"text-align: left; padding: 8px; background-color: #3c4f76; color: white; border: 1px solid black;\">Cantidad</th>\n"
                    + "\n"
                    + "    <th style = \"text-align: left; padding: 8px; background-color: #3c4f76; color: white; border: 1px solid black;\">PRECIO</th>\n"
                    + "\n";
            query = "SELECT pedido_detalle.id, producto.imagen, producto.nombre, pedido_detalle.cantidad, pedido_detalle.precio FROM  producto, pedido_detalle WHERE pedido_detalle.pedido_id = "
                    + this.id + " AND pedido_detalle.producto_id = producto.id";
            con = conexion.connect();
            consulta = con.createStatement();
            resultado = consulta.executeQuery(query);
            rsmd = resultado.getMetaData();
            int cantidadColumnas = rsmd.getColumnCount();
            while (resultado.next()) {
                response = response + "  <tr>\n" + "\n";
                for (int i = 0; i < cantidadColumnas; i++) {
                    if (i == 1) {
                        response = response
                                + "    <td style = \"text-align: left; padding: 8px; border: 1px solid black;\"><img src=\""
                                + resultado.getString(i + 1) + "\" width=\"100\" height=\"100\"></td>\n" + "\n";
                    } else {
                        response = response
                                + "    <td style = \"text-align: left; padding: 8px; border: 1px solid black;\">"
                                + resultado.getString(i + 1) + "</td>\n"
                                + "\n";
                    }
                }
                response = response + "  </tr>\n" + "\n";
            }
            response = response + "\n" + "</table> <br/>";
            response = response + "<h2>Para completar el pago escanee el codigo QR</h2>\n";
            response = response + "<br/>";
            response = response + "<img src=\"" + qr + "\" width=\"400\" height=\"400\">";
            consulta.close();
            con.close();
            return response;
        } catch (SQLException e) {
            System.out.println(e.getMessage());
            return "";
        }
    }