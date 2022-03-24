import axios from 'axios';

const baseURL = 'http://127.0.0.1:8000/api';

export function getUserList(){
    const client = axios.create({
        baseURL: baseURL,
        // headers: {Authorization: `Bear TokenValue`}
    })
    return client.get('/users')
}

export function addUser(data){
    const client = axios.create({
        baseURL: baseURL,
        // headers: {Authorization: `Bear TokenValue`}
    })
    return client.post('/user/store', {
        item: {
            "name": data['name'],
            "email": data['email'],
            "role": data['role'],
            "password": data['password']
        }
    })
}

export function updateUser(data){
    const client = axios.create({
        baseURL: baseURL,
        // headers: {Authorization: `Bear TokenValue`}
    })
    if(data['id'] !== '' && data['id'] !== undefined){
        return client.put(`user/${data['id']}`, {
            item: {
                "name": data['name'],
                "email": data['email'],
                "role": data['role']
            }
        })
    }
}
export function deleteUser(data){
    const client = axios.create({
        baseURL: baseURL,
        // headers: {Authorization: `Bear TokenValue`}
    })
    if(data['id'] !== '' && data['id'] !== undefined){
        return client.delete(`user/${data['id']}`)
    }
    
}