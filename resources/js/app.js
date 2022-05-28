require('./bootstrap')

import Alpine from 'alpinejs'
import Clipboard from "@ryangjchandler/alpine-clipboard"

window.Alpine = Alpine

Alpine.plugin(Clipboard)
Alpine.start()
