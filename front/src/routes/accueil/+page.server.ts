import { SECRET_API_URL } from '$env/static/private';

export const actions = {
    default: async ({request, fetch}) => {
        const data = await request.formData()
        console.log(typeof data.get("play"))
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
