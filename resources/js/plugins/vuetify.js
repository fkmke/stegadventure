
import '@fortawesome/fontawesome-free/css/all.css';
import { aliases, fa } from 'vuetify/iconsets/fa'
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

const lightTheme = {
    dark: false,
    colors: {
        background: "#FFFFFF",
        surface: "#FFFFFF",
        primary: "#FE3B0B",
        secondary: "#D7D7D7",
        "on-background": "#2B2E33",
        "on-surface": "#2B2E33",
        "on-primary": "#FFFFFF",
        "on-secondary": "#2B2E33",
        "error": "#FE3B0B",
    },
};

export default createVuetify({
    components,
    directives,

    theme: {
        defaultTheme: "lightTheme",
        themes: {
            lightTheme,
        },
    },
    icons: {
        defaultSet: 'fa',
        aliases,
    sets: {
      fa,
    },
      },
});
