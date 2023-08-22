/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package sistemaagua.Controlador;
/**
 *
 * @author Alan
 */
public class Factura {
    private int iDuenio;
    private double montoPagar;
    private String mes;
    private String anio;

    public Factura( int iDuenio ,double montoPagar, String mes, String anio) {
        this.iDuenio = iDuenio;
        this.montoPagar = montoPagar;
        this.mes = mes;
        this.anio = anio;
    }

    public double getMontoPagar() {
        return montoPagar;
    }

    public void setMontoPagar(double montoPagar) {
        this.montoPagar = montoPagar;
    }

    public String getAnio() {
        return anio;
    }

    public String getMes() {
        return mes;
    }

    public void setMes(String mes) {
        this.mes = mes;
    }

    @Override
    public String toString() {
        return "Controlador.Factura{" +
                "iDueño=" + iDuenio +
                ", montoPagar=" + montoPagar +
                ", mes='" + mes + '\'' +
                '}';
    }
}
