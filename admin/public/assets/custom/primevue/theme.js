import {definePreset} from '@primevue/themes';
import Lara from '@primevue/themes/lara';

const MyPreset = definePreset(Lara, {
    semantic: {
        primary: {
            50: '{indigo.50}',
            100: '{indigo.100}',
            200: '{indigo.200}',
            300: '{indigo.300}',
            400: '{indigo.400}',
            500: '{indigo.500}',
            600: '{indigo.600}',
            700: '{indigo.700}',
            800: '{indigo.800}',
            900: '{indigo.900}',
            950: '{indigo.950}'
        }
    }
});

export default {
    preset: MyPreset,
    options: {
        darkModeSelector: '.p-dark'
    }
};