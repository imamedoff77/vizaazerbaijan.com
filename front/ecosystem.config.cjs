module.exports = {
    apps: [
        {
            name: 'JomardMain',
            port: '3000',
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
