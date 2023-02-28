export default interface TodoItem {
    id: string
    user_id: string
    category_id: string
    title: string
    text: string
    completed: boolean
    order: number
    completed_at: string
    due_at: string
    created_at: string
    updated_at: string
}