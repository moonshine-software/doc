require('./bootstrap')

import Alpine from 'alpinejs'
import Clipboard from "@ryangjchandler/alpine-clipboard"
import focus from '@alpinejs/focus'


window.Alpine = Alpine

Alpine.plugin(Clipboard)
Alpine.plugin(focus)
Alpine.start()
