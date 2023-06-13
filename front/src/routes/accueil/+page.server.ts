import { SECRET_API_URL } from '$env/static/private';

export const actions = {
    default: async ({request, fetch}) => {
        const data = await request.formData()
        //const bouton = data.get("status")
        //const select = data.get("playlistSelect")
        console.log(data)
        try {
            await fetch(`${SECRET_API_URL}`, {
                method: 'POST',
                body: data
            })
        }
        catch(error) {
            return {success: false}
        }

        return {success: true}
    }
}
