module.exports = {
    apps: [
        {
            name: 'Visa Admin',
            port: '3005',
            exec_mode: 'cluster',
            instances: 1,
            script: './.output/server/index.mjs',
            args: 'start',
            env: {
                NITRO_PRESET: 'node_cluster',
            }
        }
    ]
}
