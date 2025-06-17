export const useLoadScripts = () => {
    const scripts = [
        {
            body: true,
            src: '/assets/temp/libs/bootstrap/js/bootstrap.bundle.min.js'
        },
        {
            body: true,
            src: '/assets/temp/libs/simplebar/simplebar.min.js'
        },
        {
            body: true,
            src: '/assets/temp/js/app.js'
        },
    ]

    const setScripts = (index = 0) => {
        const script = scripts[index]
        const el = document.createElement('script')
        el.src = script.src
        if (script?.body) {
            document.body.appendChild(el);
        } else {
            document.head.appendChild(el);
        }
        el.onload = () => {
            if (index < (scripts.length - 1)) {
                setScripts(index + 1)
            }
        }
    }

    setScripts()
}