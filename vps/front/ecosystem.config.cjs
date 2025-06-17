module.exports = {
    apps: [
        {
            name: 'Visa Front',
            port: '3004',
            exec_mode: 'cluster',
            instances: 'max',
            script: './.output/server/index.mjs',
            args: 'start',
            env: {
                NITRO_PRESET: 'node_cluster',
            }
        }
    ]
}
