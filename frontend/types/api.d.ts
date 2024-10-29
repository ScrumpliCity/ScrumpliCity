export interface Room {
  id: string;
  sprint_duration: number;
  number_of_sprints: number;
  name: string;
  created_at: string;
  updated_at: string;
  current_sprint: number;
  completed_at: string?;
  is_playing: boolean;
  last_play_start: string?;
  last_play_end: string?;
}
