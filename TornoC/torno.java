//Este Codigo debes adaptarlo como en el video.

public class panel extends javax.swing.JFrame {

    ComunicacionSerial_Arduino conexion = new ComunicacionSerial_Arduino();
    SerialPortEventListener listen = new SerialPortEventListener() {
        @Override
        public void serialEvent(SerialPortEvent spe) {
            try {
                if(conexion.isMessageAvailable()){
                    Distancia.setText(conexion.printMessage());
                }
            } catch (SerialPortException ex) {
                Logger.getLogger(panel.class.getName()).log(Level.SEVERE, null, ex);
            } catch (ArduinoExcepcion ex) {
                Logger.getLogger(panel.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
    };

    public panel() {
        initComponents();
        try {
            conexion.arduinoRXTX("COM8", 9600, listen);
        } catch (ArduinoExcepcion ex) {
            Logger.getLogger(panel.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
