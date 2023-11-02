const plugin = require("tailwindcss/plugin")

module.exports = {
	content: [
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
    ],
	darkMode: "class",
	theme: {
		screens: {
			xs: "375px",
			sm: "540px",
			md: "720px",
			lg: "960px",
			xl: "1140px",
			"2xl": "1550px",
		},
		container: {
			center: true,
			padding: "20px",
		},
		fontFamily: {
			sans: ["Gilroy", "sans-serif"],
		},
		fontSize: {
			xxs: ["14px", "1.6em"],
			xs: ["16px", "1.6em"],
			sm: ["18px", "1.45em"],
			md: ["20px", "1.45em"],
			lg: ["24px", "1.45em"],
			xl: ["32px", "1.3em"],
			"2xl": ["48px", "1.15em"],
			"3xl": ["76px", "1.1em"],
		},
		extend: {
			colors: {
				white: "#FFF",
				purple: "#7843E9",
				pink: "#EC4176",
				gray: "#9D9DB6",
				lightgray: "#F8FAFC",
				dark: {
					100: "#1E1F43",
					200: "#272745",
					300: "#323359",
				},
				body: "#1A1B41",
				stroke: "#424265",
			},
			borderRadius: {
				"4xl": "2rem",
				"5xl": "3rem",
			},
			transitionProperty: {
				colors: "color, background-color, border-color, text-decoration-color, box-shadow, fill, stroke",
			},
			transitionDuration: {
				DEFAULT: "350ms",
			},
			zIndex: {
				1: "1",
				2: "2",
				3: "3",
				4: "4",
				5: "5",
				modal: "1070",
				offcanvas: "1050",
			},
			keyframes: {
				wiggle: {
					"0%, 100%": { transform: "rotate(-15deg)" },
					"50%": { transform: "rotate(15deg)" },
				},
			},
			animation: {
				wiggle: "wiggle 2.5s ease-in-out infinite",
			},
		},
	},
	variants: {
		extend: {},
	},
	plugins: [
		require("@tailwindcss/forms"),
		require("@tailwindcss/typography"),
		require("@tailwindcss/aspect-ratio"),
		plugin(function ({ addVariant }) {
			addVariant("current", "&._is-active")
		}),
	],
}
