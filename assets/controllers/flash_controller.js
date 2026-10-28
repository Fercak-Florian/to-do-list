import { Controller } from '@hotwired/stimulus';
import { Alert } from 'bootstrap';

export default class extends Controller {
    connect() {
        // Lance le compte à rebours dès que le flash apparaît (4000ms = 4s)
        setTimeout(() => {
            this.close();
        }, 10000);
    }

    close() {
        // Initialise l'alerte Bootstrap sur l'élément actuel
        const alert = Alert.getOrCreateInstance(this.element);

        // Déclenche la fermeture native (gère l'animation fade-out et le .remove())
        alert.close();
    }
}
