/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package sistemaagua.Controlador;

import java.util.ArrayList;
import java.util.LinkedList;
import java.util.Queue;
/**
 *
 * @author Alan
 */
public class Deuda {
    private Queue recibos;
    private ArrayList facturas;

    public Deuda() {
        recibos = new LinkedList<Recibo>();
        facturas = new ArrayList<Factura>();
    }

    public Queue getRecibos() {
        return recibos;
    }

    public void setRecibos(Queue recibos) {
        this.recibos = recibos;
    }

    public ArrayList getFacturas() {
        return facturas;
    }

    public void setFacturas(ArrayList facturas) {
        this.facturas = facturas;
    }

    public void añadirRecibo (Recibo recibo){
        recibos.add(recibo);
    }
    public void añadirFactura (Factura factura){
        facturas.add(factura);
    }
}
